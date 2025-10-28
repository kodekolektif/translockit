<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function cookie()
    {
        // Render the privacy policy view
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;

        return view('privacy_policy.cookie',$data);
    }
    public function legal()
    {
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;
        // Render the legal notice view
        return view('privacy_policy.legal',$data);
    }
    public function privacy()
    {
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;
        // Render the privacy policy view
        return view('privacy_policy.privacy',$seo);
    }
}
