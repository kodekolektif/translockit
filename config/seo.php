<?php

return [
    // Canonical origin used for canonical URLs, hreflang links and the sitemap.
    'base_url' => env('SEO_BASE_URL', 'https://www.translockit.com'),

    // Locales served under /{locale}/...; the first one is the x-default.
    'locales' => ['en', 'es'],

    'og_locales' => [
        'en' => 'en_US',
        'es' => 'es_ES',
    ],

    // Static routes listed in the sitemap (route name => change frequency, priority).
    'sitemap_routes' => [
        'home' => ['weekly', '1.0'],
        'services' => ['monthly', '0.9'],
        'software' => ['monthly', '0.8'],
        'mobile_app' => ['monthly', '0.8'],
        'about' => ['monthly', '0.7'],
        'article.list' => ['weekly', '0.7'],
        'contact' => ['yearly', '0.6'],
        'legal_notice' => ['yearly', '0.2'],
        'privacy_policy' => ['yearly', '0.2'],
        'cookie_policy' => ['yearly', '0.2'],
    ],
];
