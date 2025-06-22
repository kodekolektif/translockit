<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $locale = request()->segment(1);

        $services = $this->getServices($locale);
        $testimonials = $this->getTestimonials($locale);

        return view('index', [
            'locale' => $locale,
            'services' => $services,
            'testimonials' => $testimonials,
        ]);
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
}
