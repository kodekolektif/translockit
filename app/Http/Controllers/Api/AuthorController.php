<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAuthorRequest;
use App\Http\Requests\Api\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Authors
 */
class AuthorController extends Controller
{
    /**
     * Display a listing of authors.
     */
    public function index(): JsonResponse
    {
        $authors = Author::where('lang', 'en')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($author) {
                return [
                    'id' => $author->unique_id,
                    'profile' => $author->profile ? asset('storage/'.$author->profile) : null,
                    'name' => $author->name,
                    'title' => $author->title,
                    'description' => $author->description,
                    'social_links' => $author->social_links,
                    'lang' => $author->lang,
                    'created_at' => $author->created_at,
                    'updated_at' => $author->updated_at,
                ];
            });


        return response()->json([
            'success' => true,
            'data' => $authors,
        ]);
    }

    /**
     * Store a newly created author.
     */
    public function store(StoreAuthorRequest $request): JsonResponse
    {

        $validated = $request->validated();

        $profilePath = null;
        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('authors', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        // Handle both nested {title: {en: '', es: ''}} and flat {title[en]: '', title[es]: ''} formats
        $titleData = $validated['title'] ?? [];
        if (!is_array($titleData) || empty($titleData)) {
            $titleData = [
                'en' => $request->input('title.en') ?? $request->input('title[en]', ''),
                'es' => $request->input('title.es') ?? $request->input('title[es]', ''),
            ];
        }

        // Handle both nested and flat formats for description
        $descriptionData = $validated['description'] ?? [];
        if (!is_array($descriptionData) || empty($descriptionData)) {
            $descriptionData = [
                'en' => $request->input('description.en') ?? $request->input('description[en]', ''),
                'es' => $request->input('description.es') ?? $request->input('description[es]', ''),
            ];
        }

        $authorEN = Author::create([
            'lang' => 'en',
            'unique_id' => $uniqueId,
            'profile' => $profilePath,
            'name' => $validated['name'],
            'title' => $titleData['en'] ?? null,
            'description' => $descriptionData['en'] ?? null,
            'social_instagram' => $validated['social_instagram'] ?? null,
            'social_linkedin' => $validated['social_linkedin'] ?? null,
            'social_facebook' => $validated['social_facebook'] ?? null,
            'social_twitter' => $validated['social_twitter'] ?? null,
        ]);

        $authorES = Author::create([
            'lang' => 'es',
            'unique_id' => $uniqueId,
            'profile' => $profilePath,
            'name' => $validated['name'],
            'title' => $titleData['es'] ?? null,
            'description' => $descriptionData['es'] ?? null,
            'social_instagram' => $validated['social_instagram'] ?? null,
            'social_linkedin' => $validated['social_linkedin'] ?? null,
            'social_facebook' => $validated['social_facebook'] ?? null,
            'social_twitter' => $validated['social_twitter'] ?? null,
        ]);
        $response = [
            'id' => $authorEN->unique_id,
            'profile' => $authorEN->profile ? asset('storage/' . $authorEN->profile) : null,
            'name' => $authorEN->name,
            'title' => [
                'en' => $authorEN->title,
                'es' => $authorES->title,
            ],
            'description' => [
                'en' => $authorEN->description,
                'es' => $authorES->description,
            ],
            'social_links' => [
                'instagram' => $authorEN->social_instagram,
                'linkedin' => $authorEN->social_linkedin,
                'facebook' => $authorEN->social_facebook,
                'twitter' => $authorEN->social_twitter,
            ],
            'lang' => $authorEN->lang,
            'created_at' => $authorEN->created_at,
            'updated_at' => $authorEN->updated_at,
        ];
        return response()->json([
            'success' => true,
            'message' => 'Author created successfully',
            'data' => $response,
        ], 201);
    }

    /**
     * Display the specified author.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $author = Author::where('unique_id', $uniqueId)->firstOrFail();
        $en = Author::where('unique_id', $uniqueId)->where('lang', 'en')->first();
        $es = Author::where('unique_id', $uniqueId)->where('lang', 'es')->first();



        $response = [
            'id' => $en->unique_id,
            'profile' => $en->profile ? asset('storage/' . $en->profile) : null,
            'name' => $en->name,
            'title' => [
                'en' => $en->title,
                'es' => $es->title,
            ],
            'description' => [
                'en' => $en->description,
                'es' => $es->description,
            ],
            'social_links' => [
                'instagram' => $en->social_instagram,
                'linkedin' => $en->social_linkedin,
                'facebook' => $en->social_facebook,
                'twitter' => $en->social_twitter,
            ],
            'lang' => $en->lang,
            'created_at' => $en->created_at,
            'updated_at' => $en->updated_at,
        ];
        return response()->json([
            'success' => true,
            'message' => 'Author created successfully',
            'data' => $response,
        ], 201);
    }

    /**
     * Update the specified author.
     */
    public function update(UpdateAuthorRequest $request, string $uniqueId): JsonResponse
    {
        $authorEn = Author::where('unique_id', $uniqueId)->where('lang', 'en')->firstOrFail();
        $authorEs = Author::where('unique_id', $uniqueId)->where('lang', 'es')->first();
        $validated = $request->validated();

        if ($request->hasFile('profile')) {
            if ($authorEn->profile) {
                Storage::disk('public')->delete($authorEn->profile);
            }
            $validated['profile'] = $request->file('profile')->store('authors', 'public');
        }

        // Update English version
        $authorEn->update([
            'profile' => $validated['profile'] ?? $authorEn->profile,
            'name' => $validated['name'] ?? $authorEn->name,
            'title' => $validated['title']['en'] ?? $authorEn->title,
            'description' => $validated['description']['en'] ?? $authorEn->description,
            'social_instagram' => $validated['social_instagram'] ?? $authorEn->social_instagram,
            'social_linkedin' => $validated['social_linkedin'] ?? $authorEn->social_linkedin,
            'social_facebook' => $validated['social_facebook'] ?? $authorEn->social_facebook,
            'social_twitter' => $validated['social_twitter'] ?? $authorEn->social_twitter,
        ]);

        // Update or create Spanish version
        if ($authorEs) {
            $authorEs->update([
                'profile' => $validated['profile'] ?? $authorEs->profile,
                'name' => $validated['name'] ?? $authorEs->name,
                'title' => $validated['title']['es'] ?? $authorEs->title,
                'description' => $validated['description']['es'] ?? $authorEs->description,
                'social_instagram' => $validated['social_instagram'] ?? $authorEs->social_instagram,
                'social_linkedin' => $validated['social_linkedin'] ?? $authorEs->social_linkedin,
                'social_facebook' => $validated['social_facebook'] ?? $authorEs->social_facebook,
                'social_twitter' => $validated['social_twitter'] ?? $authorEs->social_twitter,
            ]);
        } else {
            $authorEs = Author::create([
                'unique_id' => $uniqueId,
                'lang' => 'es',
                'profile' => $authorEn->profile,
                'name' => $validated['name'] ?? $authorEn->name,
                'title' => $validated['title']['es'] ?? $authorEn->title,
                'description' => $validated['description']['es'] ?? $authorEn->description,
                'social_instagram' => $validated['social_instagram'] ?? $authorEn->social_instagram,
                'social_linkedin' => $validated['social_linkedin'] ?? $authorEn->social_linkedin,
                'social_facebook' => $validated['social_facebook'] ?? $authorEn->social_facebook,
                'social_twitter' => $validated['social_twitter'] ?? $authorEn->social_twitter,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Author updated successfully',
            'data' => [
                'id' => $authorEn->unique_id,
                'profile' => $authorEn->profile ? asset('storage/' . $authorEn->profile) : null,
                'name' => $authorEn->name,
                'title' => [
                    'en' => $authorEn->title,
                    'es' => $authorEs->title,
                ],
                'description' => [
                    'en' => $authorEn->description,
                    'es' => $authorEs->description,
                ],
                'social_links' => [
                    'instagram' => $authorEn->social_instagram,
                    'linkedin' => $authorEn->social_linkedin,
                    'facebook' => $authorEn->social_facebook,
                    'twitter' => $authorEn->social_twitter,
                ],
                'lang' => $authorEn->lang,
                'created_at' => $authorEn->created_at,
                'updated_at' => $authorEn->updated_at,
            ],
        ]);
    }

    /**
     * Remove the specified author.
     */
    public function destroy(string $uniqueId): JsonResponse
    {
        $author = Author::where('unique_id', $uniqueId)->firstOrFail();

        if ($author->profile) {
            Storage::disk('public')->delete($author->profile);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Author deleted successfully',
        ]);
    }
}
