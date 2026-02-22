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
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->unique_id,
                    'name' => $category->name,
                    'is_active' => (bool) $category->is_active,
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

        $category = ArticleCategory::create([
            'unique_id' => $uniqueId,
            'name' => $validated['name'],
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => [
                'id' => $category->unique_id,
                'name' => $category->name,
                'is_active' => (bool) $category->is_active,
                'lang' => $category->lang,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ],
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $category = ArticleCategory::where('unique_id', $uniqueId)
            ->with('sibling')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $category->unique_id,
                'name' => $category->name,
                'is_active' => (bool) $category->is_active,
                'lang' => $category->lang,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ],
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(UpdateCategoryRequest $request, string $uniqueId): JsonResponse
    {
        $category = ArticleCategory::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => [
                'id' => $category->unique_id,
                'name' => $category->name,
                'is_active' => (bool) $category->is_active,
                'lang' => $category->lang,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
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
