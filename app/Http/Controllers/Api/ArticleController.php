<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreArticleRequest;
use App\Http\Requests\Api\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @tags Articles
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(): JsonResponse
    {
        $articles = Article::where('lang', 'en')
            ->with(['sibling', 'category', 'author'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->unique_id,
                    'thumbnail' => $article->thumbnail ? Storage::url($article->thumbnail) : null,
                    'title' => $article->title,
                    'content' => $article->content,
                    'tags' => $article->tags,
                    'is_published' => (bool) $article->is_published,
                    'published_at' => $article->published_at,
                    'lang' => $article->lang,
                    'category' => $article->category ? [
                        'id' => $article->category->unique_id,
                        'name' => $article->category->name,
                    ] : null,
                    'author' => $article->author ? [
                        'id' => $article->author->unique_id,
                        'name' => $article->author->name,
                    ] : null,
                    'created_at' => $article->created_at,
                    'updated_at' => $article->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }

    /**
     * Store a newly created article.
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        $uniqueId = Str::uuid()->toString();

        $article = Article::create([
            'unique_id' => $uniqueId,
            'thumbnail' => $thumbnailPath,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'tags' => $validated['tags'] ?? [],
            'category_id' => $validated['category_id'] ?? null,
            'author_id' => $validated['author_id'] ?? null,
            'is_published' => $validated['is_published'] ?? false,
            'published_at' => $validated['published_at'] ?? null,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        $article->load(['category', 'author']);

        return response()->json([
            'success' => true,
            'message' => 'Article created successfully',
            'data' => [
                'id' => $article->unique_id,
                'thumbnail' => $article->thumbnail ? Storage::url($article->thumbnail) : null,
                'title' => $article->title,
                'content' => $article->content,
                'tags' => $article->tags,
                'is_published' => (bool) $article->is_published,
                'published_at' => $article->published_at,
                'lang' => $article->lang,
                'category' => $article->category ? [
                    'id' => $article->category->unique_id,
                    'name' => $article->category->name,
                ] : null,
                'author' => $article->author ? [
                    'id' => $article->author->unique_id,
                    'name' => $article->author->name,
                ] : null,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
            ],
        ], 201);
    }

    /**
     * Display the specified article.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $article = Article::where('unique_id', $uniqueId)
            ->with(['sibling', 'category', 'author'])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $article->unique_id,
                'thumbnail' => $article->thumbnail ? Storage::url($article->thumbnail) : null,
                'title' => $article->title,
                'content' => $article->content,
                'tags' => $article->tags,
                'is_published' => (bool) $article->is_published,
                'published_at' => $article->published_at,
                'lang' => $article->lang,
                'category' => $article->category ? [
                    'id' => $article->category->unique_id,
                    'name' => $article->category->name,
                ] : null,
                'author' => $article->author ? [
                    'id' => $article->author->unique_id,
                    'name' => $article->author->name,
                ] : null,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
            ],
        ]);
    }

    /**
     * Update the specified article.
     */
    public function update(UpdateArticleRequest $request, string $uniqueId): JsonResponse
    {
        $article = Article::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update($validated);
        $article->load(['category', 'author']);

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => [
                'id' => $article->unique_id,
                'thumbnail' => $article->thumbnail ? Storage::url($article->thumbnail) : null,
                'title' => $article->title,
                'content' => $article->content,
                'tags' => $article->tags,
                'is_published' => (bool) $article->is_published,
                'published_at' => $article->published_at,
                'lang' => $article->lang,
                'category' => $article->category ? [
                    'id' => $article->category->unique_id,
                    'name' => $article->category->name,
                ] : null,
                'author' => $article->author ? [
                    'id' => $article->author->unique_id,
                    'name' => $article->author->name,
                ] : null,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at,
            ],
        ]);
    }

    /**
     * Remove the specified article.
     */
    public function destroy(string $uniqueId): JsonResponse
    {
        $article = Article::where('unique_id', $uniqueId)->firstOrFail();

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully',
        ]);
    }
}
