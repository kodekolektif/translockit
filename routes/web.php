<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


Route::get('/', function () {
    return Redirect::to('/en');
});

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.send');


// Grup untuk semua halaman yang memiliki prefix bahasa
Route::prefix('{locale}')
    ->where(['locale' => 'en|es']) // Hanya izinkan 'en' atau 'es'
    ->middleware(SetLocale::class) // Middleware untuk mengatur locale
    ->group(function () {
        // Halaman utama sekarang bisa diakses melalui /en atau /es
        Route::get('/', [LandingController::class, 'index'])->name('home');

        Route::get('/article', [ArticleController::class, 'index'])->name('article.list');
        Route::get('/article/{slug}',[ArticleController::class,'getDetailArticle'])->name('article.detail');

        Route::get('/about', [AboutController::class, 'index'])->name('about');
        Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
        Route::get('/services', [App\Http\Controllers\ServicesController::class, 'services'])->name('services');
        Route::get('/mobile-app', [App\Http\Controllers\SoftwareController::class, 'mobileApp'])->name('mobile_app');
        Route::get('/software', [App\Http\Controllers\SoftwareController::class, 'index'])->name('software');

        Route::get('/cookies-policy', [App\Http\Controllers\PrivacyPolicyController::class, 'cookie'])->name('cookie_policy');
        Route::get('/legal-notice', [App\Http\Controllers\PrivacyPolicyController::class, 'legal'])->name('legal_notice');
        Route::get('/privacy-policy', [App\Http\Controllers\PrivacyPolicyController::class, 'privacy'])->name('privacy_policy');
});
