<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function cookie()
    {
        // Render the privacy policy view
        return view('privacy_policy.cookie');
    }
    public function legal()
    {
        // Render the legal notice view
        return view('privacy_policy.legal');
    }
    public function privacy()
    {
        // Render the privacy policy view
        return view('privacy_policy.privacy');
    }
}
