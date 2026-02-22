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
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($author) {
                return [
                    'id' => $author->unique_id,
                    'profile' => $author->profile ? Storage::url($author->profile) : null,
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

        $author = Author::create([
            'unique_id' => $uniqueId,
            'profile' => $profilePath,
            'name' => $validated['name'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'social_links' => $validated['social_links'] ?? [],
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Author created successfully',
            'data' => [
                'id' => $author->unique_id,
                'profile' => $author->profile ? Storage::url($author->profile) : null,
                'name' => $author->name,
                'title' => $author->title,
                'description' => $author->description,
                'social_links' => $author->social_links,
                'lang' => $author->lang,
                'created_at' => $author->created_at,
                'updated_at' => $author->updated_at,
            ],
        ], 201);
    }

    /**
     * Display the specified author.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $author = Author::where('unique_id', $uniqueId)
            ->with('sibling')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $author->unique_id,
                'profile' => $author->profile ? Storage::url($author->profile) : null,
                'name' => $author->name,
                'title' => $author->title,
                'description' => $author->description,
                'social_links' => $author->social_links,
                'lang' => $author->lang,
                'created_at' => $author->created_at,
                'updated_at' => $author->updated_at,
            ],
        ]);
    }

    /**
     * Update the specified author.
     */
    public function update(UpdateAuthorRequest $request, string $uniqueId): JsonResponse
    {
        $author = Author::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('profile')) {
            if ($author->profile) {
                Storage::disk('public')->delete($author->profile);
            }
            $validated['profile'] = $request->file('profile')->store('authors', 'public');
        }

        $author->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Author updated successfully',
            'data' => [
                'id' => $author->unique_id,
                'profile' => $author->profile ? Storage::url($author->profile) : null,
                'name' => $author->name,
                'title' => $author->title,
                'description' => $author->description,
                'social_links' => $author->social_links,
                'lang' => $author->lang,
                'created_at' => $author->created_at,
                'updated_at' => $author->updated_at,
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
