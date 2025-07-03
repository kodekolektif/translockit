<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

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
        if(isset($search)) {
            $search = strtolower($search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(title) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(content) LIKE ?', ['%' . $search . '%']);
            });
        }



        $data['latest_article'] = Article::with(['category'])
        ->where('lang', $lang)
        ->whereNotNull('published_at')
        ->orderBy('published_at','desc')
        ->limit(5)
        ->get();

        $data['articles'] = $query->orderBy('published_at', 'desc')->paginate(10);
        $data['categories'] = ArticleCategory::where('lang', $lang)->get();

        return view("news-list",$data);
    }

    public function getDetailArticle($lang,$slug){
        $article = Article::where("slug", $slug)->with(['category'])->first();
        $data['title'] = $article->title;
        $data['article'] = $article;
        $data['latest_article'] = Article::with(['category'])
        ->where('lang', $lang)
        ->whereNotNull('published_at')
        ->orderBy('published_at','desc')
        ->limit(5)
        ->get();
        $data['categories'] = ArticleCategory::where('lang', $lang)->get();
        return view('news-detail',$data);
    }

}
