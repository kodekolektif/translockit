<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSoftwareRequest;
use App\Http\Requests\Api\UpdateSoftwareRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Software
 */
class SoftwareController extends Controller
{
    public function index(): JsonResponse
    {
        $software = Product::where('lang', 'en')
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->unique_id,
                    'name' => $item->name,
                    'logo' => $item->logo ? Storage::url($item->logo) : null,
                    'description' => $item->description,
                    'is_active' => (bool) $item->is_active,
                    'lang' => $item->lang,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $software,
        ]);
    }

    public function store(StoreSoftwareRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('software', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        $software = Product::create([
            'unique_id' => $uniqueId,
            'name' => $validated['name'],
            'logo' => $logoPath,
            'description' => $validated['description'],
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Software created successfully',
            'data' => [
                'id' => $software->unique_id,
                'name' => $software->name,
                'logo' => $software->logo ? Storage::url($software->logo) : null,
                'description' => $software->description,
                'is_active' => (bool) $software->is_active,
                'lang' => $software->lang,
                'created_at' => $software->created_at,
                'updated_at' => $software->updated_at,
            ],
        ], 201);
    }

    public function show(string $uniqueId): JsonResponse
    {
        $software = Product::where('unique_id', $uniqueId)
            ->with('sibling')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $software->unique_id,
                'name' => $software->name,
                'logo' => $software->logo ? Storage::url($software->logo) : null,
                'description' => $software->description,
                'is_active' => (bool) $software->is_active,
                'lang' => $software->lang,
                'created_at' => $software->created_at,
                'updated_at' => $software->updated_at,
            ],
        ]);
    }

    public function update(UpdateSoftwareRequest $request, string $uniqueId): JsonResponse
    {
        $software = Product::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($software->logo) {
                Storage::disk('public')->delete($software->logo);
            }
            $validated['logo'] = $request->file('logo')->store('software', 'public');
        }

        $software->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Software updated successfully',
            'data' => [
                'id' => $software->unique_id,
                'name' => $software->name,
                'logo' => $software->logo ? Storage::url($software->logo) : null,
                'description' => $software->description,
                'is_active' => (bool) $software->is_active,
                'lang' => $software->lang,
                'created_at' => $software->created_at,
                'updated_at' => $software->updated_at,
            ],
        ]);
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $software = Product::where('unique_id', $uniqueId)->firstOrFail();

        if ($software->logo) {
            Storage::disk('public')->delete($software->logo);
        }

        $software->delete();

        return response()->json([
            'success' => true,
            'message' => 'Software deleted successfully',
        ]);
    }
}
