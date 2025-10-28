<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServicesController extends Controller
{
    public function services($lang)
    {
        $data['title'] = 'Our Services';
        $data['description'] = 'Explore the services we offer to our clients.';
        $data['services'] =  Cache::remember('get_service_'.$lang, now()->addDay(), function () use ($lang) {
            return Service::where('is_active',true)
            ->where('lang', $lang)
            ->get();
        });
        $data['projects'] = $this->getProject($lang);
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;
        // Logic to handle services
        return view('services', $data);
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
