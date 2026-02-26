<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCategoryRequest;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Models\ArticleCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

/**
 * @tags Categories
 */
class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): JsonResponse
    {
        $categories = ArticleCategory::where('lang', 'en')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->unique_id,
                    'name' => $category->name,
                    'is_active' => true,
                    'lang' => $category->lang,
                    'created_at' => $category->created_at,
                    'updated_at' => $category->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $uniqueId = Str::uuid()->toString();

        // Handle both nested {name: {en: '', es: ''}} and flat {name[en]: '', name[es]: ''} formats
        $nameData = $validated['name'];
        if (!is_array($nameData)) {
            $nameData = [
                'en' => $request->input('name.en') ?? $request->input('name[en]', ''),
                'es' => $request->input('name.es') ?? $request->input('name[es]', ''),
            ];
        }

        // Create English version
        $categoryEn = ArticleCategory::create([
            'unique_id' => $uniqueId,
            'name' => $nameData['en'] ?? '',
            'lang' => 'en',
        ]);

        // Create Spanish version
        $categoryEs = ArticleCategory::create([
            'unique_id' => $uniqueId,
            'name' => $nameData['es'] ?? $nameData['en'] ?? '',
            'lang' => 'es',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => [
                'id' => $categoryEn->unique_id,
                'name' => [
                    'en' => $categoryEn->name,
                    'es' => $categoryEs->name,
                ],
                'is_active' => true,
                'lang' => $categoryEn->lang,
                'created_at' => $categoryEn->created_at,
                'updated_at' => $categoryEn->updated_at,
            ],
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $categoryEn = ArticleCategory::where('unique_id', $uniqueId)->where('lang', 'en')->firstOrFail();
        $categoryEs = ArticleCategory::where('unique_id', $uniqueId)->where('lang', 'es')->first();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $categoryEn->unique_id,
                'name' => [
                    'en' => $categoryEn->name,
                    'es' => $categoryEs?->name,
                ],
                'is_active' => true,
                'lang' => $categoryEn->lang,
                'created_at' => $categoryEn->created_at,
                'updated_at' => $categoryEn->updated_at,
            ],
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(UpdateCategoryRequest $request, string $uniqueId): JsonResponse
    {
        $categoryEn = ArticleCategory::where('unique_id', $uniqueId)->where('lang', 'en')->firstOrFail();
        $categoryEs = ArticleCategory::where('unique_id', $uniqueId)->where('lang', 'es')->first();
        $validated = $request->validated();

        // Handle both nested and flat formats for name
        $nameData = $validated['name'] ?? [];
        if (!is_array($nameData) || empty($nameData)) {
            $nameData = [
                'en' => $request->input('name.en') ?? $request->input('name[en]') ?? $categoryEn->name,
                'es' => $request->input('name.es') ?? $request->input('name[es]') ?? $categoryEs?->name ?? $categoryEn->name,
            ];
        }

        // Update English version
        $categoryEn->update([
            'name' => $nameData['en'] ?? $categoryEn->name,
        ]);

        // Update or create Spanish version
        if ($categoryEs) {
            $categoryEs->update([
                'name' => $nameData['es'] ?? $categoryEs->name,
            ]);
        } else {
            $categoryEs = ArticleCategory::create([
                'unique_id' => $uniqueId,
                'name' => $nameData['es'] ?? $categoryEn->name,
                'lang' => 'es',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => [
                'id' => $categoryEn->unique_id,
                'name' => [
                    'en' => $categoryEn->name,
                    'es' => $categoryEs->name,
                ],
                'is_active' => true,
                'lang' => $categoryEn->lang,
                'created_at' => $categoryEn->created_at,
                'updated_at' => $categoryEn->updated_at,
            ],
        ]);
    }

    /**
     * Remove the specified category.
     */
    public function destroy(string $uniqueId): JsonResponse
    {
        $category = ArticleCategory::where('unique_id', $uniqueId)->firstOrFail();
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
        ]);
    }
}
