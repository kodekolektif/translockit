<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        return view('news-detail', $data);
    }

}
