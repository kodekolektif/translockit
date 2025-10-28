<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutController extends Controller
{
    public function index($locale = null)
    {
        $about = Cache::remember('get_about_'.$locale, now()->addDay(), function () use ($locale) {
            return \App\Models\About::where('lang', $locale ?? app()->getLocale())
                ->where('is_active', true)
                ->get();
        });
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');

        return view('about', [
            'about' => $about,
            'locale' => $locale,
            'title' => __('About Us'),
            'seo' => $seo
        ]);
    }
}
