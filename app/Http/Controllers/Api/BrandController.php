<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBrandRequest;
use App\Http\Requests\Api\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

/**
 * @tags Brands
 */
class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        $brands = Brand::orderBy('created_at', 'desc')->get()->map(function ($brand) {
            return [
                'id' => $brand->id,
                'brand_name' => $brand->brand_name,
                'logo' => $brand->logo ? Storage::url($brand->logo) : null,
                'is_active' => (bool) $brand->is_active,
                'created_at' => $brand->created_at,
                'updated_at' => $brand->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $brands,
        ]);
    }

    public function store(StoreBrandRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
        }

        $brand = Brand::create([
            'brand_name' => $validated['brand_name'],
            'logo' => $logoPath,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Brand created successfully',
            'data' => [
                'id' => $brand->id,
                'brand_name' => $brand->brand_name,
                'logo' => $brand->logo ? Storage::url($brand->logo) : null,
                'is_active' => (bool) $brand->is_active,
                'created_at' => $brand->created_at,
                'updated_at' => $brand->updated_at,
            ],
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $brand = Brand::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $brand->id,
                'brand_name' => $brand->brand_name,
                'logo' => $brand->logo ? Storage::url($brand->logo) : null,
                'is_active' => (bool) $brand->is_active,
                'created_at' => $brand->created_at,
                'updated_at' => $brand->updated_at,
            ],
        ]);
    }

    public function update(UpdateBrandRequest $request, int $id): JsonResponse
    {
        $brand = Brand::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $validated['logo'] = $request->file('logo')->store('brands', 'public');
        }

        $brand->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Brand updated successfully',
            'data' => [
                'id' => $brand->id,
                'brand_name' => $brand->brand_name,
                'logo' => $brand->logo ? Storage::url($brand->logo) : null,
                'is_active' => (bool) $brand->is_active,
                'created_at' => $brand->created_at,
                'updated_at' => $brand->updated_at,
            ],
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $brand = Brand::findOrFail($id);

        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully',
        ]);
    }
}
