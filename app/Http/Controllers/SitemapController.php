<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $xml = Cache::remember('sitemap_xml', now()->addHours(6), function () {
            $base = rtrim(config('seo.base_url'), '/');
            $locales = config('seo.locales');
            $urls = [];

            // Static pages in every language, each linked to its translations.
            foreach (config('seo.sitemap_routes') as $name => [$freq, $priority]) {
                $alternates = [];
                foreach ($locales as $loc) {
                    $alternates[$loc] = $base . parse_url(route($name, ['locale' => $loc]), PHP_URL_PATH);
                }
                foreach ($alternates as $loc => $loc_url) {
                    $urls[] = ['loc' => $loc_url, 'freq' => $freq, 'priority' => $priority, 'lastmod' => null, 'alternates' => $alternates];
                }
            }

            // Published articles, linked to their translation when one exists.
            $articles = Article::where('is_published', true)
                ->whereIn('lang', $locales)
                ->get(['lang', 'slug', 'unique_id', 'updated_at', 'published_at']);
            $byUnique = $articles->groupBy('unique_id');

            foreach ($articles as $article) {
                $alternates = [];
                foreach ($byUnique[$article->unique_id] ?? [] as $twin) {
                    $alternates[$twin->lang] = $base . '/' . $twin->lang . '/article/' . $twin->slug;
                }
                $urls[] = [
                    'loc' => $base . '/' . $article->lang . '/article/' . $article->slug,
                    'freq' => 'monthly',
                    'priority' => '0.6',
                    'lastmod' => optional($article->updated_at ?? $article->published_at)->toAtomString(),
                    'alternates' => count($alternates) > 1 ? $alternates : [],
                ];
            }

            return view('sitemap', ['urls' => $urls, 'defaultLocale' => $locales[0]])->render();
        });

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
