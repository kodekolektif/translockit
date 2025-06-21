<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function (Request $request) {
    // Redirect to /en if locale is not set in the URL
    return Redirect::to('/en');
});

Route::prefix('{locale}')->where(['locale' => 'en|es'])->group(function () {
    Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
    Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
});
