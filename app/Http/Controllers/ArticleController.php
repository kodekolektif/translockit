<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class ArticleController extends Controller
{

    public function index()
    {
        $data['title'] = 'Article';
        $lang = app()->getLocale();
        $category = request()->input("category");
        $search = request()->input("search");

        $query = Article::with('category')
            ->where('lang', $lang)
            ->whereNotNull('published_at');

        if (!empty($category)) {
            $query->where('category_id', $category);
        }

        if (isset($search)) {
            $search = strtolower($search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(title) LIKE ?', ['%' . $search . '%'])
                ->orWhereRaw('LOWER(content) LIKE ?', ['%' . $search . '%']);
            });
        }

        // ✅ cache latest articles 1 day
        $data['latest_article'] = Cache::remember("latest_article_$lang", now()->addDay(), function () use ($lang) {
            return Article::with('category')
                ->where('lang', $lang)
                ->whereNotNull('published_at')
                ->orderBy('published_at','desc')
                ->limit(5)
                ->get();
        });

        // ✅ cached categories 1 day
        $data['categories'] = Cache::remember("article_categories_$lang", now()->addDay(), function () use ($lang) {
            return ArticleCategory::where('lang', $lang)->get();
        });

        // ⚠️ articles list (search/filter) → sebaiknya tidak dicache
        $data['articles'] = $query->orderBy('published_at', 'desc')->paginate(10);
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;
        return view("news-list",$data);
    }

    public function getDetailArticle($lang, $slug)
    {
        // ✅ cache detail article 1 day
        $article = Cache::remember("article_detail_{$lang}_{$slug}", now()->addDay(), function () use ($slug) {
            return Article::where("slug", $slug)->with(['category'])->first();
        });

        if (!$article) {
            abort(404); // jika tidak ditemukan
        }

        $data['title'] = $article->title;
        $data['article'] = $article;

        // ✅ cache latest article 1 day
        $data['latest_article'] = Cache::remember("latest_article_$lang", now()->addDay(), function () use ($lang) {
            return Article::with('category')
                ->where('lang', $lang)
                ->whereNotNull('published_at')
                ->orderBy('published_at','desc')
                ->limit(5)
                ->get();
        });

        // ✅ cache categories 1 day
        $data['categories'] = Cache::remember("article_categories_$lang", now()->addDay(), function () use ($lang) {
            return ArticleCategory::where('lang', $lang)->get();
        });
        $data['hideloading'] = true;

        if ($article->thumbnail) {
            $originalPath = $article->thumbnail; // e.g. "thumbnails/foo.jpg"
            $disk = Storage::disk('public');

            // Ensure original image exists
            if ($disk->exists($originalPath)) {
                // Define optimized OG image name (same dir + -og suffix)
                $ext = pathinfo($originalPath, PATHINFO_EXTENSION);
                $name = pathinfo($originalPath, PATHINFO_FILENAME);
                $ogPath = "thumbnails/{$name}-og.{$ext}";

                // ✅ If OG version already exists, just use it
                if (!$disk->exists($ogPath)) {
                    // Read image binary
                    $imgContent = $disk->get($originalPath);

                    // Create image from binary
                    $img = Image::read($imgContent)
                        ->scaleDown(width: 1200)  // shrink proportionally
                        ->cover(1200, 630)        // crop to OG ratio
                        ->toJpeg(quality: 75);    // compress

                    // Save optimized OG image
                    $disk->put($ogPath, (string) $img);
                }

                // ✅ Set SEO image URL
                $seo['image'] = $disk->url($ogPath);
            } else {
                // File missing
                $seo['image'] = asset('images/default-seo.jpg');
            }
        } else {
            // No thumbnail defined
            $seo['image'] = asset('images/default-seo.jpg');
        }


        $seo['tags']  = is_array($article->tags)
        ? implode(', ', $article->tags)
        : (string) $article->tags;
        $seo['title'] = $article->title;
        $seo['description'] = str(strip_tags($article->content))->limit(200);
        $data['seo'] = $seo;

        return view('news-detail', $data);
    }

    public function recentArticle(Request $request)
    {
        $readArticles = $request->input('read_articles', []);
        $lang = app()->getLocale();

        if (empty($readArticles)) {
            return response()->json([]);
        }

        // Balik array supaya yang paling terakhir dibaca muncul paling atas
        $readArticles = array_reverse($readArticles);

        // Build CASE WHEN
        $orderCases = [];
        foreach ($readArticles as $index => $slug) {
            $orderCases[] = "WHEN slug = '$slug' THEN $index";
        }

        $orderSql = "CASE " . implode(' ', $orderCases) . " END";

        $latestArticle = Article::with('category')
            ->where('lang', $lang)
            ->whereNotNull('published_at')
            ->whereIn('slug', $readArticles)
            ->orderByRaw($orderSql)
            ->limit(5)
            ->get();

        return response()->json($latestArticle);
    }


}
