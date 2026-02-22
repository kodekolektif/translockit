<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTestimonialRequest;
use App\Http\Requests\Api\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Testimonials
 */
class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::where('lang', 'en')
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($testimonial) {
                return [
                    'id' => $testimonial->unique_id,
                    'name' => $testimonial->name,
                    'title' => $testimonial->title,
                    'content' => $testimonial->content,
                    'image' => $testimonial->image ? Storage::url($testimonial->image) : null,
                    'is_active' => (bool) $testimonial->is_active,
                    'lang' => $testimonial->lang,
                    'created_at' => $testimonial->created_at,
                    'updated_at' => $testimonial->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $testimonials,
        ]);
    }

    public function store(StoreTestimonialRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        $testimonial = Testimonial::create([
            'unique_id' => $uniqueId,
            'name' => $validated['name'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Testimonial created successfully',
            'data' => [
                'id' => $testimonial->unique_id,
                'name' => $testimonial->name,
                'title' => $testimonial->title,
                'content' => $testimonial->content,
                'image' => $testimonial->image ? Storage::url($testimonial->image) : null,
                'is_active' => (bool) $testimonial->is_active,
                'lang' => $testimonial->lang,
                'created_at' => $testimonial->created_at,
                'updated_at' => $testimonial->updated_at,
            ],
        ], 201);
    }

    public function show(string $uniqueId): JsonResponse
    {
        $testimonial = Testimonial::where('unique_id', $uniqueId)
            ->with('sibling')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $testimonial->unique_id,
                'name' => $testimonial->name,
                'title' => $testimonial->title,
                'content' => $testimonial->content,
                'image' => $testimonial->image ? Storage::url($testimonial->image) : null,
                'is_active' => (bool) $testimonial->is_active,
                'lang' => $testimonial->lang,
                'created_at' => $testimonial->created_at,
                'updated_at' => $testimonial->updated_at,
            ],
        ]);
    }

    public function update(UpdateTestimonialRequest $request, string $uniqueId): JsonResponse
    {
        $testimonial = Testimonial::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Testimonial updated successfully',
            'data' => [
                'id' => $testimonial->unique_id,
                'name' => $testimonial->name,
                'title' => $testimonial->title,
                'content' => $testimonial->content,
                'image' => $testimonial->image ? Storage::url($testimonial->image) : null,
                'is_active' => (bool) $testimonial->is_active,
                'lang' => $testimonial->lang,
                'created_at' => $testimonial->created_at,
                'updated_at' => $testimonial->updated_at,
            ],
        ]);
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $testimonial = Testimonial::where('unique_id', $uniqueId)->firstOrFail();

        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial deleted successfully',
        ]);
    }
}
