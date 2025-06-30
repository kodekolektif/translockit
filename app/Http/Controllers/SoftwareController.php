<?php

namespace App\Http\Controllers;

use App\Models\MobileApp;
use App\Models\MobileList;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function index()
    {
        return view('software');
    }
    public function mobileApp($lang)
    {
        $data['title'] = 'Mobile App';
        $data['mobile_apps'] = MobileApp::where(['is_active' => true, 'lang' => $lang])->get();
        $data['mobile_list'] = MobileList::where(['is_active'=>true,'lang'=>$lang])->get();
        return view('mobile-app', $data);
    }
}
