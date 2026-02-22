<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAboutRequest;
use App\Http\Requests\Api\UpdateAboutRequest;
use App\Models\About;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Abouts
 */
class AboutController extends Controller
{
    /**
     * Display a listing of about entries.
     */
    public function index(): JsonResponse
    {
        $abouts = About::where('lang', 'en')
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($about) {
                return [
                    'id' => $about->unique_id,
                    'image' => $about->image ? Storage::url($about->image) : null,
                    'title' => $about->title,
                    'description' => $about->description,
                    'is_active' => (bool) $about->is_active,
                    'lang' => $about->lang,
                    'created_at' => $about->created_at,
                    'updated_at' => $about->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $abouts,
        ]);
    }

    /**
     * Store a newly created about entry.
     */
    public function store(StoreAboutRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('abouts', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        $about = About::create([
            'unique_id' => $uniqueId,
            'image' => $imagePath,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'About entry created successfully',
            'data' => [
                'id' => $about->unique_id,
                'image' => $about->image ? Storage::url($about->image) : null,
                'title' => $about->title,
                'description' => $about->description,
                'is_active' => (bool) $about->is_active,
                'lang' => $about->lang,
                'created_at' => $about->created_at,
                'updated_at' => $about->updated_at,
            ],
        ], 201);
    }

    /**
     * Display the specified about entry.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $about = About::where('unique_id', $uniqueId)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $about->unique_id,
                'image' => $about->image ? Storage::url($about->image) : null,
                'title' => $about->title,
                'description' => $about->description,
                'is_active' => (bool) $about->is_active,
                'lang' => $about->lang,
                'created_at' => $about->created_at,
                'updated_at' => $about->updated_at,
            ],
        ]);
    }

    /**
     * Update the specified about entry.
     */
    public function update(UpdateAboutRequest $request, string $uniqueId): JsonResponse
    {
        $about = About::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $validated['image'] = $request->file('image')->store('abouts', 'public');
        }

        $about->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'About entry updated successfully',
            'data' => [
                'id' => $about->unique_id,
                'image' => $about->image ? Storage::url($about->image) : null,
                'title' => $about->title,
                'description' => $about->description,
                'is_active' => (bool) $about->is_active,
                'lang' => $about->lang,
                'created_at' => $about->created_at,
                'updated_at' => $about->updated_at,
            ],
        ]);
    }

    /**
     * Remove the specified about entry.
     */
    public function destroy(string $uniqueId): JsonResponse
    {
        $about = About::where('unique_id', $uniqueId)->firstOrFail();

        // Delete image if exists
        if ($about->image) {
            Storage::disk('public')->delete($about->image);
        }

        $about->delete();

        return response()->json([
            'success' => true,
            'message' => 'About entry deleted successfully',
        ]);
    }
}
