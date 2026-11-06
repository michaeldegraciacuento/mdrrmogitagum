<?php

use App\Services\WeatherService;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (WeatherService $weather) => view('welcome', [
    'weather' => $weather->forecast(),
]))->name('home');

Route::get('/sitemap.xml', function () {
    $lastmod = date('Y-m-d', filemtime(resource_path('views/welcome.blade.php')));

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
        .'<url><loc>'.e(url('/')).'</loc><lastmod>'.$lastmod.'</lastmod>'
        .'<changefreq>weekly</changefreq><priority>1.0</priority></url>'
        .'</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

Route::get('/robots.txt', function () {
    $body = app()->isProduction()
        ? "User-agent: *\nAllow: /\n\nSitemap: ".url('/sitemap.xml')."\n"
        : "User-agent: *\nDisallow: /\n"; // keep staging/local out of search results

    return response($body, 200, ['Content-Type' => 'text/plain']);
})->name('robots');
