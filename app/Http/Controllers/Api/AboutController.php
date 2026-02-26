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
                    'image' => $about->image ? asset('storage/' . $about->image) : null,
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
     * Display a listing of about entries grouped by unique_id.
     */
    public function grouped(): JsonResponse
    {
        $abouts = About::orderBy('created_at', 'desc')
            ->get()
            ->groupBy('unique_id')
            ->map(function ($group) {
                $abouts = $group->map(function ($about) {
                    return [
                        'id' => $about->unique_id,
                        'image' => $about->image ? asset('storage/' . $about->image) : null,
                        'title' => $about->title,
                        'description' => $about->description,
                        'is_active' => (bool) $about->is_active,
                        'lang' => $about->lang,
                        'created_at' => $about->created_at,
                        'updated_at' => $about->updated_at,
                    ];
                });

                return [
                    'unique_id' => $group->first()->unique_id,
                    'translations' => $abouts->values(),
                ];
            })
            ->values();

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
        $lang = $validated['lang'] ?? 'en';

        // Extract title and description for both languages
        $titleData = is_array($validated['title']) ? $validated['title'] : ['en' => $validated['title'], 'es' => $validated['title']];
        $descriptionData = is_array($validated['description']) ? $validated['description'] : ['en' => $validated['description'], 'es' => $validated['description']];

        // Create English version
        $aboutEn = About::create([
            'unique_id' => $uniqueId,
            'image' => $imagePath,
            'title' => $titleData['en'] ?? '',
            'description' => $descriptionData['en'] ?? '',
            'is_active' => $validated['is_active'] ?? true,
            'lang' => 'en',
        ]);

        // Create Spanish version
        $aboutEs = About::create([
            'unique_id' => $uniqueId,
            'image' => $imagePath,
            'title' => $titleData['es'] ?? $titleData['en'] ?? '',
            'description' => $descriptionData['es'] ?? $descriptionData['en'] ?? '',
            'is_active' => $validated['is_active'] ?? true,
            'lang' => 'es',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'About entry created successfully',
            'data' => [
                'id' => $aboutEn->unique_id,
                'image' => $aboutEn->image ? asset('storage/' . $aboutEn->image) : null,
                'title' => $aboutEn->title,
                'description' => $aboutEn->description,
                'is_active' => (bool) $aboutEn->is_active,
                'lang' => $aboutEn->lang,
                'created_at' => $aboutEn->created_at,
                'updated_at' => $aboutEn->updated_at,
            ],
        ], 201);
    }

    /**
     * Display the specified about entry.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $aboutEn = About::where('unique_id', $uniqueId)->where('lang', 'en')->firstOrFail();
        $aboutEs = About::where('unique_id', $uniqueId)->where('lang', 'es')->first();

        $response = [
            'id' => $aboutEn->unique_id,
            'image' => $aboutEn->image ? asset('storage/' . $aboutEn->image) : null,
            'title' => $aboutEn->title,
            'description' => $aboutEn->description,
            'is_active' => (bool) $aboutEn->is_active,
            'lang' => $aboutEn->lang,
            'created_at' => $aboutEn->created_at,
            'updated_at' => $aboutEn->updated_at,
        ];

        // Add Spanish translation if exists
        if ($aboutEs) {
            $response['translations'] = [
                [
                    'id' => $aboutEs->unique_id,
                    'image' => $aboutEs->image ? asset('storage/' . $aboutEs->image) : null,
                    'title' => $aboutEs->title,
                    'description' => $aboutEs->description,
                    'is_active' => (bool) $aboutEs->is_active,
                    'lang' => $aboutEs->lang,
                    'created_at' => $aboutEs->created_at,
                    'updated_at' => $aboutEs->updated_at,
                ],
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $response,
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
            // Delete old image from both language versions
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $validated['image'] = $request->file('image')->store('abouts', 'public');
        }

        // Get both language versions
        $aboutEn = About::where('unique_id', $uniqueId)->where('lang', 'en')->first();
        $aboutEs = About::where('unique_id', $uniqueId)->where('lang', 'es')->first();

        // Handle array values for title and description - update both languages
        $titleData = $request->input('title');
        $descriptionData = $request->input('description');

        // Update/create title for both languages
        if ($titleData) {
            $titleEn = is_array($titleData) ? ($titleData['en'] ?? ($aboutEn ? $aboutEn->title : '')) : $titleData;
            $titleEs = is_array($titleData) ? ($titleData['es'] ?? ($aboutEs ? $aboutEs->title : $titleEn)) : $titleData;

            if ($aboutEn) {
                $aboutEn->update(['title' => $titleEn]);
            }

            if ($aboutEs) {
                $aboutEs->update(['title' => $titleEs]);
            } else {
                // Create Spanish version if it doesn't exist
                $aboutEs = About::create([
                    'unique_id' => $uniqueId,
                    'image' => $aboutEn?->image,
                    'title' => $titleEs,
                    'description' => $aboutEn?->description ?? '',
                    'is_active' => $aboutEn?->is_active ?? true,
                    'lang' => 'es',
                ]);
            }
        }

        // Update/create description for both languages
        if ($descriptionData) {
            $descEn = is_array($descriptionData) ? ($descriptionData['en'] ?? ($aboutEn ? $aboutEn->description : '')) : $descriptionData;
            $descEs = is_array($descriptionData) ? ($descriptionData['es'] ?? ($aboutEs ? $aboutEs->description : $descEn)) : $descriptionData;

            if ($aboutEn) {
                $aboutEn->update(['description' => $descEn]);
            }

            if ($aboutEs) {
                $aboutEs->update(['description' => $descEs]);
            } else {
                // Create Spanish version if it doesn't exist
                $aboutEs = About::create([
                    'unique_id' => $uniqueId,
                    'image' => $aboutEn?->image,
                    'title' => $aboutEn?->title ?? '',
                    'description' => $descEs,
                    'is_active' => $aboutEn?->is_active ?? true,
                    'lang' => 'es',
                ]);
            }
        }

        // Update other fields on the English version
        $updateData = array_diff_key($validated, ['title' => 1, 'description' => 1, 'lang' => 1]);
        if (!empty($updateData) && $aboutEn) {
            $aboutEn->update($updateData);
            $about = $aboutEn;
        }

        return response()->json([
            'success' => true,
            'message' => 'About entry updated successfully',
            'data' => [
                'id' => $about->unique_id,
                'image' => $about->image ? asset('storage/' . $about->image) : null,
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
