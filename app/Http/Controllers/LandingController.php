<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        $locale = request()->segment(1);

        $data['services']       = $this->getProject($locale);
        // $data['testimonials']   = $this->getTestimonials($locale);
        $data['articles']       = $this->getArticle($locale);
        // $data['brands']         = $this->getBrands();
        $data['projects']       = $this->getProject($locale);
        $data['title'] = 'Top-notch advanced technology consulting firm';
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;

        return view('landing', $data);
    }

    public function getServices($lang)
    {
        return Cache::remember('get_service_'.$lang, now()->addDay(), function () use ($lang) {
            return \App\Models\Service::where('lang', $lang)
            ->where('is_active', true)
            ->get();
        });

    }
    public function getTestimonials($lang)
    {
        return Cache::remember('get_testimonial_'.$lang, now()->addDay(), function () use ($lang) {
            return \App\Models\Testimonial::where('is_active', true)
            ->where('lang', $lang)
            ->orderBy('created_at', 'desc')
            ->get();
        });
    }

    public function getArticle($lang)
    {
        return Cache::remember('get_article_'.$lang, now()->addDay(), function () use ($lang) {
            return Article::where('is_published',true)
                ->where('lang',$lang)
                ->orderBy('published_at','desc')
                ->limit(6)
                ->get();
        });
    }

    public function getBrands()
    {
        return Cache::remember('get_brands', now()->addDay(), function () {
            return \App\Models\Brand::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        });
    }

    public function getProject($lang){
        return Cache::remember('get_project_'.$lang, now()->addDay(), function () use ($lang) {
            return \App\Models\Project::where('lang', $lang)
                ->where('is_active', true)
                ->orderBy('order', 'asc')
                ->get();
        });
    }



}
