<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $locale = request()->segment(1);

        $data['services']       = $this->getServices($locale);
        // $data['testimonials']   = $this->getTestimonials($locale);
        $data['articles']       = $this->getArticle($locale);
        // $data['brands']         = $this->getBrands();
        $data['projects']       = $this->getProject($locale);

        return view('landing', $data);
    }

    public function getServices($lang)
    {
        // Fetch services based on the language
        $services = \App\Models\Service::where('lang', $lang)
        ->where('is_active', true)
        ->get();
        return $services;

    }
    public function getTestimonials($lang)
    {
        // Fetch testimonials based on the language
        $testimonials = \App\Models\Testimonial::where('is_active', true)
        ->where('lang', $lang)
        ->orderBy('created_at', 'desc')
        ->get();
        return $testimonials;
    }

    public function getArticle($lang)
    {
        return Article::where('is_published',true)
            ->where('lang',$lang)
            ->orderBy('published_at','desc')
            ->limit(6)
            ->get();
    }

    public function getBrands()
    {
        return \App\Models\Brand::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getProject($lang){
        return \App\Models\Project::where('lang', $lang)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }



}
