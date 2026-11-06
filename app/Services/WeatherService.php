<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * 7-day weather forecast for Gitagum from Open-Meteo (free, no API key).
 * Results are cached so the page stays fast and keeps working if the API is down.
 */
class WeatherService
{
    private const ENDPOINT = 'https://api.open-meteo.com/v1/forecast';

    /** Daily rainfall (mm) at or above this is flagged as heavy rain. */
    public const HEAVY_RAIN_MM = 20;

    public function forecast(): ?array
    {
        $fresh = Cache::get('weather.forecast');
        if ($fresh) {
            return $fresh;
        }

        $data = $this->fetch();

        if ($data) {
            Cache::put('weather.forecast', $data, now()->addMinutes(30));
            Cache::forever('weather.forecast.last_good', $data);

            return $data;
        }

        // API unavailable: fall back to the last good forecast (if any).
        return Cache::get('weather.forecast.last_good');
    }

    private function fetch(): ?array
    {
        $location = config('mdrrmo.weather');

        try {
            $response = Http::timeout(5)->retry(1, 300, throw: false)->get(self::ENDPOINT, [
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'timezone' => 'Asia/Manila',
                'forecast_days' => 7,
                'current' => 'temperature_2m,relative_humidity_2m,apparent_temperature,weather_code,wind_speed_10m,is_day',
                'daily' => 'weather_code,temperature_2m_max,temperature_2m_min,precipitation_probability_max,precipitation_sum',
            ]);

            if (! $response->successful()) {
                return null;
            }

            $json = $response->json();
            $current = $json['current'];
            $daily = $json['daily'];

            $days = [];
            foreach ($daily['time'] as $i => $date) {
                $rain = (float) $daily['precipitation_sum'][$i];
                $days[] = [
                    'date' => $date,
                    'condition' => self::describe((int) $daily['weather_code'][$i]),
                    'max' => (int) round($daily['temperature_2m_max'][$i]),
                    'min' => (int) round($daily['temperature_2m_min'][$i]),
                    'rain_chance' => (int) $daily['precipitation_probability_max'][$i],
                    'rain_mm' => round($rain, 1),
                    'heavy_rain' => $rain >= self::HEAVY_RAIN_MM,
                ];
            }

            return [
                'updated_at' => $current['time'],
                'current' => [
                    'temperature' => (int) round($current['temperature_2m']),
                    'feels_like' => (int) round($current['apparent_temperature']),
                    'humidity' => (int) $current['relative_humidity_2m'],
                    'wind' => (int) round($current['wind_speed_10m']),
                    'is_day' => (bool) $current['is_day'],
                    'condition' => self::describe((int) $current['weather_code'], (bool) $current['is_day']),
                ],
                'days' => $days,
            ];
        } catch (Throwable $e) {
            Log::warning('Weather forecast unavailable: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Map a WMO weather code to a label and an icon key.
     *
     * @return array{label: string, icon: string}
     */
    public static function describe(int $code, bool $isDay = true): array
    {
        [$label, $icon] = match (true) {
            $code === 0 => ['Clear sky', $isDay ? 'sun' : 'moon'],
            $code === 1 => ['Mainly clear', $isDay ? 'sun' : 'moon'],
            $code === 2 => ['Partly cloudy', 'cloud-sun'],
            $code === 3 => ['Overcast', 'cloud'],
            in_array($code, [45, 48]) => ['Foggy', 'fog'],
            in_array($code, [51, 53, 55, 56, 57]) => ['Drizzle', 'drizzle'],
            in_array($code, [61, 80]) => ['Light rain', 'rain'],
            in_array($code, [63, 81, 66]) => ['Moderate rain', 'rain'],
            in_array($code, [65, 82, 67]) => ['Heavy rain', 'rain'],
            $code === 95 => ['Thunderstorms', 'storm'],
            in_array($code, [96, 99]) => ['Severe thunderstorms', 'storm'],
            default => ['Cloudy', 'cloud'],
        };

        return ['label' => $label, 'icon' => $icon];
    }
}
