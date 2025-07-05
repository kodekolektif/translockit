<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function services($lang)
    {
        $data['title'] = 'Our Services';
        $data['description'] = 'Explore the services we offer to our clients.';
        $data['services'] = Service::where('is_active',true)
        ->where('lang', $lang)
        ->latest()
        ->get();
        $data['projects'] = $this->getProject($lang);
        // Logic to handle services
        return view('services', $data);
    }

    public function getProject($lang){
        return \App\Models\Project::where('lang', $lang)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }


}
