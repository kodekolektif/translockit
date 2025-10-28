<?php

namespace App\Http\Controllers;

use App\Models\MobileApp;
use App\Models\MobileList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SoftwareController extends Controller
{
    public function index()
    {
        $data['title'] = 'Software';
        $lang = app()->getLocale();
        $data['software_lists'] = Cache::remember('get_product_'.$lang, now()->addDay(), function () use ($lang) {
            return Product::where(['is_active'=>true,'lang'=>$lang])->get();
        });
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;
        return view('software',$data);
    }
    public function mobileApp($lang)
    {
        $data['title'] = 'Mobile App';
        $data['mobile_apps'] = Cache::remember('get_mobile_app_'.$lang, now()->addDay(), function () use ($lang) {
            return MobileApp::where(['is_active' => true, 'lang' => $lang])->get();
        });
        $data['mobile_list'] = Cache::remember('get_mobile_list_'.$lang, now()->addDay(), function () use ($lang) {
            return MobileList::where(['is_active'=>true,'lang'=>$lang])->get();
        });
        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;
        return view('mobile-app', $data);
    }
}
