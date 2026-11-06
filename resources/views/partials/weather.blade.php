@php
    use Illuminate\Support\Carbon;

    // Weather icons (Lucide, ISC license)
    $weatherIcons = [
        'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>',
        'moon' => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
        'cloud' => '<path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>',
        'cloud-sun' => '<path d="M12 2v2m-7.07.93 1.41 1.41M20 12h2m-2.93-7.07-1.41 1.41M15.95 12.65a4 4 0 0 0-5.93-4.13"/><path d="M13 22H7a5 5 0 1 1 4.9-6H13a3 3 0 0 1 0 6Z"/>',
        'fog' => '<path d="M4 14.9A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.24"/><path d="M16 17H7m10 4H9"/>',
        'drizzle' => '<path d="M4 14.9A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.24"/><path d="M8 19v1m0-6v1m8 4v1m0-6v1m-4 6v1m0-6v1"/>',
        'rain' => '<path d="M4 14.9A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.24"/><path d="M16 14v6M8 14v6m4-4v6"/>',
        'storm' => '<path d="M6 16.33A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 .5 8.97"/><path d="m13 12-3 5h4l-3 5"/>',
    ];
    $icon = fn (string $key, string $class) => '<svg class="'.$class.'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.($weatherIcons[$key] ?? $weatherIcons['cloud']).'</svg>';

    $today = now('Asia/Manila')->toDateString();
    $heavyRainDays = $weather ? collect($weather['days'])->where('heavy_rain', true) : collect();
@endphp

<section id="weather" class="py-20" aria-labelledby="weather-title">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="max-w-2xl">
                <span class="section-eyebrow">Weather Watch</span>
                <h2 id="weather-title" class="section-title">7-Day Weather Forecast for Gitagum</h2>
            </div>
            <a href="https://www.pagasa.dost.gov.ph/" target="_blank" rel="noopener" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
                Official PAGASA advisories &rarr;
            </a>
        </div>

        @if ($weather)
            @if ($heavyRainDays->isNotEmpty())
                <div class="mt-8 flex gap-3 rounded-2xl border border-brand-200 bg-brand-50 p-4 text-sm text-brand-900" role="alert">
                    <svg class="mt-0.5 size-5 shrink-0 text-brand-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                    <p>
                        <strong>Heavy rainfall expected</strong> on
                        {{ $heavyRainDays->map(fn ($d) => Carbon::parse($d['date'])->format('l, M j'))->join(', ', ' and ') }}.
                        Residents in low-lying, riverside and coastal areas should stay alert and monitor MDRRMO advisories.
                    </p>
                </div>
            @endif

            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                {{-- Current conditions --}}
                @php $now = $weather['current']; @endphp
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-brand-500 to-brand-700 p-7 text-white shadow-xl shadow-brand-600/20">
                    <div class="pointer-events-none absolute -right-10 -top-10 size-40 rounded-full bg-white/10" aria-hidden="true"></div>
                    <p class="text-sm font-medium text-white/80">Right now in Gitagum</p>
                    <div class="mt-4 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-6xl font-extrabold tracking-tight">{{ $now['temperature'] }}&deg;<span class="text-3xl font-bold text-white/70">C</span></p>
                            <p class="mt-1 text-lg font-semibold">{{ $now['condition']['label'] }}</p>
                        </div>
                        {!! $icon($now['condition']['icon'], 'size-20 text-white/90') !!}
                    </div>
                    <dl class="mt-7 grid grid-cols-3 gap-3 border-t border-white/20 pt-5 text-center">
                        <div><dt class="text-xs text-white/70">Feels like</dt><dd class="mt-0.5 font-bold">{{ $now['feels_like'] }}&deg;C</dd></div>
                        <div><dt class="text-xs text-white/70">Humidity</dt><dd class="mt-0.5 font-bold">{{ $now['humidity'] }}%</dd></div>
                        <div><dt class="text-xs text-white/70">Wind</dt><dd class="mt-0.5 font-bold">{{ $now['wind'] }} km/h</dd></div>
                    </dl>
                    <p class="mt-5 text-xs text-white/70">
                        Updated {{ Carbon::parse($weather['updated_at'], 'Asia/Manila')->format('M j, g:i A') }} (PHT)
                    </p>
                </div>

                {{-- Daily forecast --}}
                <ol class="grid gap-2 sm:grid-cols-4 sm:gap-3 lg:col-span-2 lg:grid-cols-7">
                    @foreach ($weather['days'] as $day)
                        @php $date = Carbon::parse($day['date']); $isToday = $day['date'] === $today; @endphp
                        <li @class([
                            'flex items-center gap-4 rounded-2xl border px-4 py-3 sm:flex-col sm:justify-center sm:gap-0 sm:p-4 sm:text-center',
                            'border-brand-300 bg-brand-50/60' => $isToday,
                            'border-stone-100 bg-white' => ! $isToday,
                        ])>
                            <div class="w-16 shrink-0 sm:w-auto">
                                <p class="text-sm font-bold text-stone-900">{{ $isToday ? 'Today' : $date->format('D') }}</p>
                                <p class="text-xs text-stone-500">{{ $date->format('M j') }}</p>
                            </div>
                            {!! $icon($day['condition']['icon'], 'size-8 shrink-0 sm:my-3 sm:size-9 '.($day['heavy_rain'] ? 'text-brand-700' : 'text-brand-500')) !!}
                            <p class="flex-1 truncate text-sm text-stone-600 sm:hidden">{{ $day['condition']['label'] }}</p>
                            <p class="sr-only max-sm:hidden">{{ $day['condition']['label'] }}</p>
                            <p class="text-sm">
                                <span class="font-bold text-stone-900">{{ $day['max'] }}&deg;</span>
                                <span class="text-stone-400">{{ $day['min'] }}&deg;</span>
                            </p>
                            <p class="inline-flex w-12 items-center justify-end gap-1 text-xs font-medium text-sky-700 sm:mt-2 sm:w-auto sm:justify-center" title="Chance of rain">
                                <svg class="size-3" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.7c-.3 0-.6.2-.8.4C9.6 5.3 6 10 6 14a6 6 0 0 0 12 0c0-4-3.6-8.7-5.2-10.9a1 1 0 0 0-.8-.4Z"/></svg>
                                {{ $day['rain_chance'] }}%
                            </p>
                        </li>
                    @endforeach
                </ol>
            </div>

            <p class="mt-6 text-xs text-stone-500">
                Forecast data by <a href="https://open-meteo.com/" target="_blank" rel="noopener" class="underline hover:text-brand-600">Open-Meteo.com</a>.
                This forecast is for general guidance only. For official weather bulletins, typhoon signals and warnings, always refer to PAGASA and MDRRMO Gitagum announcements.
            </p>
        @else
            <div class="mt-8 rounded-2xl border border-stone-100 bg-stone-50 p-8 text-center">
                <p class="font-semibold text-stone-800">The weather forecast is temporarily unavailable.</p>
                <p class="mt-1 text-sm text-stone-600">
                    Please check <a href="https://www.pagasa.dost.gov.ph/" target="_blank" rel="noopener" class="font-semibold text-brand-600 hover:underline">PAGASA</a>
                    or our <a href="{{ config('mdrrmo.facebook') }}" target="_blank" rel="noopener" class="font-semibold text-brand-600 hover:underline">Facebook page</a> for the latest updates.
                </p>
            </div>
        @endif
    </div>
</section>
