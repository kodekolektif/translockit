<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ArticleCategoryController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AppSettingsController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CompanySettingsController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\MobileAppController;
use App\Http\Controllers\Api\MobileListController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SoftwareController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\TranslationController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/category', [ArticleController::class, 'getCategories']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // About CRUD
    Route::apiResource('abouts', AboutController::class)->parameter('about', 'uniqueId');
    Route::get('abouts-grouped', [AboutController::class, 'grouped']);

    // Article CRUD
    Route::apiResource('articles', ArticleController::class)->parameter('article', 'uniqueId');
    Route::get('articles-grouped', [ArticleController::class, 'grouped']);

    // Author CRUD
    Route::apiResource('authors', AuthorController::class)->parameter('author', 'uniqueId');

    // Category CRUD
    Route::apiResource('categories', ArticleCategoryController::class)->parameter('category', 'uniqueId');

    // Brand CRUD
    Route::apiResource('brands', BrandController::class);

    // Testimonial CRUD
    Route::apiResource('testimonials', TestimonialController::class)->parameter('testimonial', 'uniqueId');

    // Software CRUD
    Route::apiResource('software', SoftwareController::class)->parameter('software', 'uniqueId');

    // Project CRUD
    Route::apiResource('projects', ProjectController::class)->parameter('project', 'uniqueId');

    // Mobile App CRUD
    Route::apiResource('mobile-apps', MobileAppController::class)->parameter('mobileApp', 'uniqueId');

    // Mobile List CRUD
    Route::apiResource('mobile-lists', MobileListController::class)->parameter('mobileList', 'uniqueId');

    // FAQ CRUD
    Route::apiResource('faqs', FaqController::class)->parameter('faq', 'uniqueId');

    // Settings
    Route::get('/settings/app', [AppSettingsController::class, 'show']);
    Route::put('/settings/app', [AppSettingsController::class, 'update']);
    Route::get('/settings/company', [CompanySettingsController::class, 'show']);
    Route::put('/settings/company', [CompanySettingsController::class, 'update']);

    // Translation
    Route::post('/translate', [TranslationController::class, 'translate']);
    Route::post('/translate/batch', [TranslationController::class, 'batchTranslate']);
});
