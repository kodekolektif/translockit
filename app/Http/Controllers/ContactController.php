<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        $data['title'] = "Contact Us";
        $settings = Cache::remember('company_settings', now()->addDay(), function () {
            return new \App\Settings\CompanySetting();
        });
        $data['phone'] = $settings->phone;
        $data['email'] = $settings->email;
        $data['address'] = $settings->address;
        $data['google_map_url'] = $settings->google_map_url;
        $data['embed_google_url'] = $settings->embed_google_url;

        $seo['tags'] = "it company";
        $seo['description'] = "With high specialization in the development of customized technology services, Artificial Intelligence (AI), comprehensive IT software solutions and customized mobile applications.";
        $seo['image'] = asset('assets/img/about/About-TranslockIt_1.jpg');
        $data['seo'] = $seo;

        return view('contact',$data);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Simpan data kontak ke database atau kirim email
        // Logika penyimpanan atau pengiriman email di sini

        // Redirect atau tampilkan pesan sukses
        return response()->json([
            'status' => 'success',
            'responseText' => __('Contact message sent successfully!')
        ]);
    }


}
