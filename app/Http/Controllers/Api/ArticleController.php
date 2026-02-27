<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreArticleRequest;
use App\Http\Requests\Api\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
            ->with(['sibling'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($article) {
                $category = $article->englishCategory;
                $author = $article->englishAuthor;

                return [
                    'id' => $article->unique_id,
                    'thumbnail' => $article->thumbnail ? asset('storage/' . $article->thumbnail) : null,
                    'title' => $article->title,
                    'content' => $article->content,
                    'tags' => $article->tags,
                    'is_published' => (bool) $article->is_published,
                    'published_at' => $article->published_at,
                    'lang' => $article->lang,
                    'category' => $category ? [
                        'id' => $category->unique_id,
                        'name' => $category->name,
                    ] : null,
                    'author' => $author ? [
                        'id' => $author->unique_id,
                        'name' => $author->name,
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
     * Display a listing of articles grouped by unique_id.
     */
    public function grouped(): JsonResponse
    {
        $articles = Article::orderBy('created_at', 'desc')
            ->get()
            ->groupBy('unique_id')
            ->map(function ($group) {
                $articles = $group->map(function ($article) {
                    $category = $article->englishCategory;
                    $author = $article->englishAuthor;

                    return [
                        'id' => $article->unique_id,
                        'thumbnail' => $article->thumbnail ? asset('storage/' . $article->thumbnail) : null,
                        'title' => $article->title,
                        'content' => $article->content,
                        'tags' => $article->tags,
                        'is_published' => (bool) $article->is_published,
                        'published_at' => $article->published_at,
                        'lang' => $article->lang,
                        'category' => $category ? [
                            'id' => $category->unique_id,
                            'name' => $category->name,
                        ] : null,
                        'author' => $author ? [
                            'id' => $author->unique_id,
                            'name' => $author->name,
                        ] : null,
                        'created_at' => $article->created_at,
                        'updated_at' => $article->updated_at,
                    ];
                });

                return [
                    'unique_id' => $group->first()->unique_id,
                    'translations' => $articles->values(),
                ];
            })
            ->values();

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
        Log::info('Creating article with data: ' . json_encode($request->all(), JSON_UNESCAPED_SLASHES));
        $validated = $request->validated();

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        $uniqueId = Str::uuid()->toString();
        $lang = $validated['lang'] ?? 'en';

        // Extract title and content for both languages
        $titleData = is_array($validated['title']) ? $validated['title'] : ['en' => $validated['title'], 'es' => $validated['title']];
        $contentData = is_array($validated['content']) ? $validated['content'] : ['en' => $validated['content'], 'es' => $validated['content']];

        // Generate slugs from titles
        $slugEn = Str::slug($titleData['en'] ?? '');
        $slugEs = Str::slug($titleData['es'] ?? $titleData['en'] ?? '');

        // Extract category_id (support multiple formats)
        $categoryId = null;
        if (isset($validated['category_id'])) {
            $categoryId = $validated['category_id'];
            if (is_array($categoryId)) {
                $categoryId = $categoryId[$lang] ?? $categoryId['en'] ?? null;
            }
        } elseif (isset($validated['category'])) {
            $categoryData = $validated['category'];
            if (is_array($categoryData)) {
                $categoryName = $categoryData[$lang] ?? $categoryData['en'] ?? $categoryData['name'] ?? null;
                if ($categoryName) {
                    $category = \App\Models\ArticleCategory::where('name', $categoryName)->where('lang', $lang)->first();
                    if (!$category) {
                        $category = \App\Models\ArticleCategory::create([
                            'name' => $categoryName,
                            'lang' => $lang,
                            'unique_id' => Str::uuid()->toString(),
                        ]);
                    }
                    $categoryId = $category->unique_id;
                }
            }
        }

        // Extract author_id (support multiple formats)
        $authorId = null;
        if (isset($validated['author_id'])) {
            $authorId = $validated['author_id'];
            if (is_array($authorId)) {
                $authorId = $authorId[$lang] ?? $authorId['en'] ?? null;
            }
        } elseif (isset($validated['author'])) {
            $authorData = $validated['author'];
            if (is_array($authorData)) {
                $authorName = $authorData[$lang] ?? $authorData['en'] ?? $authorData['name'] ?? null;
                if ($authorName) {
                    $author = \App\Models\Author::where('name', $authorName)->where('lang', $lang)->first();
                    if (!$author) {
                        $author = \App\Models\Author::create([
                            'name' => $authorName,
                            'lang' => $lang,
                            'unique_id' => Str::uuid()->toString(),
                        ]);
                    }
                    $authorId = $author->unique_id;
                }
            }
        }

        // Extract tags (support array of strings or comma-separated string)
        $tags = $validated['tags'] ?? [];
        if (is_string($tags)) {
            $tags = array_filter(array_map('trim', explode(',', $tags)));
        }

        // Create English version
        $articleEn = Article::create([
            'unique_id' => $uniqueId,
            'slug' => $slugEn,
            'thumbnail' => $thumbnailPath,
            'title' => $titleData['en'] ?? '',
            'content' => $contentData['en'] ?? '',
            'tags' => $tags,
            'category_id' => $categoryId,
            'author_id' => $authorId,
            'is_published' => $validated['is_published'] ?? false,
            'published_at' => $validated['is_published'] ? now() : null,
            'lang' => 'en',
        ]);

        // Create Spanish version
        $articleEs = Article::create([
            'unique_id' => $uniqueId,
            'slug' => $slugEs,
            'thumbnail' => $thumbnailPath,
            'title' => $titleData['es'] ?? $titleData['en'] ?? '',
            'content' => $contentData['es'] ?? $contentData['en'] ?? '',
            'tags' => $tags,
            'category_id' => $categoryId,
            'author_id' => $authorId,
            'is_published' => $validated['is_published'] ?? false,
            'published_at' => $validated['is_published'] ? now() : null,
            'lang' => 'es',
        ]);

        $category = $articleEn->englishCategory;
        $author = $articleEn->englishAuthor;

        return response()->json([
            'success' => true,
            'message' => 'Article created successfully',
            'data' => [
                'id' => $articleEn->unique_id,
                'thumbnail' => $articleEn->thumbnail ? asset('storage/' . $articleEn->thumbnail) : null,
                'title' => $articleEn->title,
                'content' => $articleEn->content,
                'tags' => $articleEn->tags,
                'is_published' => (bool) $articleEn->is_published,
                'published_at' => $articleEn->published_at,
                'lang' => $articleEn->lang,
                'category' => $category ? [
                    'id' => $category->unique_id,
                    'name' => $category->name,
                ] : null,
                'author' => $author ? [
                    'id' => $author->unique_id,
                    'name' => $author->name,
                ] : null,
                'created_at' => $articleEn->created_at,
                'updated_at' => $articleEn->updated_at,
            ],
        ], 201);
    }

    /**
     * Display the specified article.
     */
    public function show(string $uniqueId): JsonResponse
    {
        $article = Article::where('unique_id', $uniqueId)->get();
        $en = $article->where('lang', 'en')->first();
        $es = $article->where('lang', 'es')->first();
        if (!$en) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found',
            ], 404);
        }
        $categoryEn = $en->englishCategory;
        $categoryEs = $es->englishCategory;

        $authorEn = $en->englishAuthor;
        $authorEs = $es->englishAuthor;


        $response['id'] = $en->unique_id;
        $response['thumbnail'] = $en->thumbnail ? asset('storage/' . $en->thumbnail) : ($es->thumbnail ? asset('storage/' . $es->thumbnail) : null);
        $response['title'] = [
            'en' => $en->title,
            'es' => $es->title ?? $en->title,
        ];
        $response['content'] = [
            'en' => $en->content,
            'es' => $es->content ?? $en->content,
        ];

        $response['category'] = $categoryEn ? [
            'id' => $categoryEn->unique_id,
            'name' => $categoryEn->name,
        ] : ($categoryEs ? [
            'id' => $categoryEs->unique_id,
            'name' => $categoryEs->name,
        ] : null);
        $response['author'] = $authorEn ? [
            'id' => $authorEn->unique_id,
            'name' => $authorEn->name,
        ] : ($authorEs ? [
            'id' => $authorEs->unique_id,
            'name' => $authorEs->name,
        ] : null);
        $response['tags'] = $en->tags ?: $es->tags;
        $response['is_published'] = (bool) ($en->is_published ?? $es->is_published);
        $response['published_at'] = $en->published_at ?? $es->published_at;
        return response()->json([
            'success' => true,
            'data' => $response,
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

        // Handle array values for title and content
        if (isset($validated['title'])) {
            $lang = $validated['lang'] ?? $article->lang ?? 'en';
            $validated['title'] = is_array($validated['title']) ? ($validated['title'][$lang] ?? $validated['title']['en'] ?? $article->title) : $validated['title'];
        }

        if (isset($validated['content'])) {
            $lang = $validated['lang'] ?? $article->lang ?? 'en';
            $validated['content'] = is_array($validated['content']) ? ($validated['content'][$lang] ?? $validated['content']['en'] ?? $article->content) : $validated['content'];
        }

        // Handle array values for category_id and author_id
        if (isset($validated['category_id']) && is_array($validated['category_id'])) {
            $lang = $validated['lang'] ?? $article->lang ?? 'en';
            $validated['category_id'] = $validated['category_id'][$lang] ?? $validated['category_id']['en'] ?? null;
        }

        if (isset($validated['author_id']) && is_array($validated['author_id'])) {
            $lang = $validated['lang'] ?? $article->lang ?? 'en';
            $validated['author_id'] = $validated['author_id'][$lang] ?? $validated['author_id']['en'] ?? null;
        }
        if(isset($validated['is_published'])) {
            $validated['published_at'] = $validated['is_published'] ? now() : null;
        }

        $article->update($validated);

        $category = $article->englishCategory;
        $author = $article->englishAuthor;

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => [
                'id' => $article->unique_id,
                'thumbnail' => $article->thumbnail ? asset('storage/' . $article->thumbnail) : null,
                'title' => $article->title,
                'content' => $article->content,
                'tags' => $article->tags,
                'is_published' => (bool) $article->is_published,
                'published_at' => $article->published_at,
                'lang' => $article->lang,
                'category' => $category ? [
                    'id' => $category->unique_id,
                    'name' => $category->name,
                ] : null,
                'author' => $author ? [
                    'id' => $author->unique_id,
                    'name' => $author->name,
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
    public function getCategories(): JsonResponse
    {
        $categories = \App\Models\ArticleCategory::where('lang', 'en')->get()->map(function ($category) {
            return [
                'id' => $category->unique_id,
                'name' => $category->name,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }
}
