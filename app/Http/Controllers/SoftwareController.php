<?php

namespace App\Http\Controllers;

use App\Models\MobileApp;
use App\Models\MobileList;
use App\Models\Product;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function index()
    {
        $data['title'] = 'Software';
        $lang = app()->getLocale();
        $data['software_lists'] = Product::where(['is_active'=>true,'lang'=>$lang])->get();
        return view('software',$data);
    }
    public function mobileApp($lang)
    {
        $data['title'] = 'Mobile App';
        $data['mobile_apps'] = MobileApp::where(['is_active' => true, 'lang' => $lang])->get();
        $data['mobile_list'] = MobileList::where(['is_active'=>true,'lang'=>$lang])->get();
        return view('mobile-app', $data);
    }
}
