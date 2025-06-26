<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index($locale = null)
    {
        $about = \App\Models\About::where('lang', $locale ?? app()->getLocale())
            ->where('is_active', true)
            ->get();
        return view('about', [
            'about' => $about,
            'locale' => $locale,
            'title' => __('About Us'),
        ]);
    }
}
