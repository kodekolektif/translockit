@php
    $seoBase = rtrim(config('seo.base_url'), '/');
    $seoLocale = app()->getLocale();
    $seoLocales = config('seo.locales');
    $seoRoute = request()->route();
    $seoRouteName = $seoRoute?->getName();
    $seoParams = $seoRoute ? $seoRoute->parameters() : [];
    $seoIsArticle = $seoRouteName === 'article.detail' && isset($article);
    $seoBrand = $APPtitle ?: 'Translock IT';

    // Error pages (404, 500...) get a plain title, no canonical/hreflang and noindex.
    $seoErrorCode = isset($exception) && method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : (isset($exception) ? 500 : null);
    if ($seoErrorCode) {
        $seoRouteName = null;
        $seo = ['title' => \Illuminate\Support\Facades\Lang::has("errors.$seoErrorCode.title") ? __("errors.$seoErrorCode.title") : (string) $seoErrorCode, 'description' => __('errors.404.text')];
    }

    // Static pages take their title and description from lang/{locale}/seo.php.
    $seoHasCopy = ! $seoIsArticle && $seoRouteName && \Illuminate\Support\Facades\Lang::has("seo.$seoRouteName.title");
    $seoTitle = $seoHasCopy ? __("seo.$seoRouteName.title") : trim((string) ($seo['title'] ?? $title ?? ''));
    $seoFullTitle = $seoRouteName === 'home' && $seoHasCopy
        ? $seoTitle
        : ($seoTitle === '' ? $seoBrand : (str_contains($seoTitle, $seoBrand) ? $seoTitle : $seoTitle . ' | ' . $seoBrand));
    $seoDescription = $seoHasCopy
        ? __("seo.$seoRouteName.description")
        : trim(preg_replace('/\s+/', ' ', strip_tags((string) ($seo['description'] ?? $description ?? $settings->description))));
    $seoImage = $seo['image'] ?? asset('assets/img/about/About-TranslockIt_1.jpg');

    // Canonical: fixed host, no query string, no trailing slash.
    $seoPath = trim(request()->path(), '/');
    $seoCanonical = $seoBase . ($seoPath === '' ? '' : '/' . $seoPath);

    // Language alternates for hreflang.
    $seoAlternates = [];
    if ($seoRouteName && isset($seoParams['locale'])) {
        foreach ($seoLocales as $loc) {
            if ($seoIsArticle) {
                if ($loc === $seoLocale) {
                    $seoAlternates[$loc] = $seoCanonical;
                } elseif ($article->sibling && $article->sibling->lang === $loc && $article->sibling->is_published) {
                    $seoAlternates[$loc] = $seoBase . '/' . $loc . '/article/' . $article->sibling->slug;
                }
            } else {
                $seoAlternates[$loc] = $seoBase . parse_url(route($seoRouteName, array_merge($seoParams, ['locale' => $loc])), PHP_URL_PATH);
            }
        }
    }

    // Structured data.
    $seoOrgId = $seoBase . '/#organization';
    $seoGraph = [
        [
            '@type' => 'Organization',
            '@id' => $seoOrgId,
            'name' => 'Translock IT',
            'url' => $seoBase . '/',
            'logo' => !empty($settings->logo) ? url(Storage::url($settings->logo)) : null,
            'email' => 'info@translockit.com',
            'description' => __('landing.footer_descriptoon'),
            'knowsAbout' => ['Artificial Intelligence', 'Custom software development', 'Mobile app development', 'Cloud migration', 'Cybersecurity', 'Transport and mobility technology'],
        ],
        [
            '@type' => 'WebSite',
            '@id' => $seoBase . '/#website',
            'url' => $seoBase . '/',
            'name' => 'Translock IT',
            'inLanguage' => $seoLocales,
            'publisher' => ['@id' => $seoOrgId],
        ],
        [
            '@type' => 'WebPage',
            '@id' => $seoCanonical . '#webpage',
            'url' => $seoCanonical,
            'name' => $seoFullTitle,
            'description' => $seoDescription,
            'inLanguage' => $seoLocale,
            'isPartOf' => ['@id' => $seoBase . '/#website'],
        ],
    ];
    if ($seoIsArticle) {
        $seoGraph[] = array_filter([
            '@type' => 'BlogPosting',
            '@id' => $seoCanonical . '#article',
            'mainEntityOfPage' => ['@id' => $seoCanonical . '#webpage'],
            'headline' => \Illuminate\Support\Str::limit((string) $article->title, 110, ''),
            'description' => $seoDescription,
            'image' => $seoImage,
            'inLanguage' => $seoLocale,
            'datePublished' => optional($article->published_at ?? $article->created_at)->toAtomString(),
            'dateModified' => optional($article->updated_at)->toAtomString(),
            'author' => $article->author?->name ? ['@type' => 'Person', 'name' => $article->author->name] : ['@id' => $seoOrgId],
            'publisher' => ['@id' => $seoOrgId],
            'keywords' => is_array($article->tags) ? implode(', ', $article->tags) : null,
        ]);
    }
    $seoGraph = array_map(fn ($node) => array_filter($node, fn ($v) => $v !== null && $v !== ''), $seoGraph);
@endphp
    <title>{{ $seoFullTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
@unless ($seoErrorCode)
    <link rel="canonical" href="{{ $seoCanonical }}">
@endunless
@foreach ($seoAlternates as $loc => $href)
    <link rel="alternate" hreflang="{{ $loc }}" href="{{ $href }}">
@endforeach
@if (count($seoAlternates) > 1 && isset($seoAlternates[$seoLocales[0]]))
    <link rel="alternate" hreflang="x-default" href="{{ $seoAlternates[$seoLocales[0]] }}">
@endif
    <meta name="robots" content="{{ $seoErrorCode ? 'noindex, follow' : 'index, follow, max-image-preview:large' }}">

    <meta property="og:title" content="{{ $seoTitle ?: $seoBrand }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:site_name" content="Translock IT">
    <meta property="og:type" content="{{ $seoIsArticle ? 'article' : 'website' }}">
    <meta property="og:locale" content="{{ config('seo.og_locales.' . $seoLocale, $seoLocale) }}">
@foreach (array_diff(array_keys($seoAlternates), [$seoLocale]) as $loc)
    <meta property="og:locale:alternate" content="{{ config('seo.og_locales.' . $loc, $loc) }}">
@endforeach

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle ?: $seoBrand }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@graph' => $seoGraph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
