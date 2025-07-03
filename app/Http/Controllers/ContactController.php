<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $title = "Contact Us";
        $settings = new \App\Settings\CompanySetting();
        $phone = $settings->phone;
        $email = $settings->email;
        $address = $settings->address;
        $google_map_url = $settings->google_map_url;
        $embed_google_url = $settings->embed_google_url;
        return view('contact', compact(
            'title',
            'phone',
            'email',
            'address',
            'google_map_url',
            'embed_google_url'
        ));
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
