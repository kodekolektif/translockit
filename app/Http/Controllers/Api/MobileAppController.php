<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMobileAppRequest;
use App\Http\Requests\Api\UpdateMobileAppRequest;
use App\Models\MobileApp;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Mobile Apps
 */
class MobileAppController extends Controller
{
    public function index(): JsonResponse
    {
        $mobileApps = MobileApp::where('lang', 'en')
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($app) {
                return [
                    'id' => $app->unique_id,
                    'image' => $app->image ? Storage::url($app->image) : null,
                    'title' => $app->title,
                    'description' => $app->description,
                    'is_active' => (bool) $app->is_active,
                    'lang' => $app->lang,
                    'created_at' => $app->created_at,
                    'updated_at' => $app->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $mobileApps,
        ]);
    }

    public function store(StoreMobileAppRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('mobile-apps', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        $mobileApp = MobileApp::create([
            'unique_id' => $uniqueId,
            'image' => $imagePath,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mobile app created successfully',
            'data' => [
                'id' => $mobileApp->unique_id,
                'image' => $mobileApp->image ? Storage::url($mobileApp->image) : null,
                'title' => $mobileApp->title,
                'description' => $mobileApp->description,
                'is_active' => (bool) $mobileApp->is_active,
                'lang' => $mobileApp->lang,
                'created_at' => $mobileApp->created_at,
                'updated_at' => $mobileApp->updated_at,
            ],
        ], 201);
    }

    public function show(string $uniqueId): JsonResponse
    {
        $mobileApp = MobileApp::where('unique_id', $uniqueId)
            ->with('sibling')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $mobileApp->unique_id,
                'image' => $mobileApp->image ? Storage::url($mobileApp->image) : null,
                'title' => $mobileApp->title,
                'description' => $mobileApp->description,
                'is_active' => (bool) $mobileApp->is_active,
                'lang' => $mobileApp->lang,
                'created_at' => $mobileApp->created_at,
                'updated_at' => $mobileApp->updated_at,
            ],
        ]);
    }

    public function update(UpdateMobileAppRequest $request, string $uniqueId): JsonResponse
    {
        $mobileApp = MobileApp::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($mobileApp->image) {
                Storage::disk('public')->delete($mobileApp->image);
            }
            $validated['image'] = $request->file('image')->store('mobile-apps', 'public');
        }

        $mobileApp->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Mobile app updated successfully',
            'data' => [
                'id' => $mobileApp->unique_id,
                'image' => $mobileApp->image ? Storage::url($mobileApp->image) : null,
                'title' => $mobileApp->title,
                'description' => $mobileApp->description,
                'is_active' => (bool) $mobileApp->is_active,
                'lang' => $mobileApp->lang,
                'created_at' => $mobileApp->created_at,
                'updated_at' => $mobileApp->updated_at,
            ],
        ]);
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $mobileApp = MobileApp::where('unique_id', $uniqueId)->firstOrFail();

        if ($mobileApp->image) {
            Storage::disk('public')->delete($mobileApp->image);
        }

        $mobileApp->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mobile app deleted successfully',
        ]);
    }
}
