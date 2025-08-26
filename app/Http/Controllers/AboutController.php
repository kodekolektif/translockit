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
        return view('about', [
            'about' => $about,
            'locale' => $locale,
            'title' => __('About Us'),
        ]);
    }
}
