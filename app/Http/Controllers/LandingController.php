<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $locale = request()->segment(1);

        $services = $this->getServices($locale);

        return view('index', [
            'locale' => $locale,
            'services' => $services,
        ]);
    }

    public function getServices($lang)
    {
        // Fetch services based on the language
        $services = \App\Models\Service::where('lang', $lang)->get();
        return $services;

    }
}
