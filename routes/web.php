<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


Route::get('/', function () {
    return Redirect::to('/en');
});

// Grup untuk semua halaman yang memiliki prefix bahasa
Route::prefix('{locale}')
    ->where(['locale' => 'en|es']) // Hanya izinkan 'en' atau 'es'
    ->middleware(SetLocale::class) // Middleware untuk mengatur locale
    ->group(function () {
        // Halaman utama sekarang bisa diakses melalui /en atau /es
        Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

        // Halaman lain
        Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
        // ... tambahkan route lain di sini
});
