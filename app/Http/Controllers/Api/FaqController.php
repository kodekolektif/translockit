<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreFaqRequest;
use App\Http\Requests\Api\UpdateFaqRequest;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

/**
 * @tags FAQs
 */
class FaqController extends Controller
{
    public function index(): JsonResponse
    {
        $faqs = Faq::where('lang', 'en')
            ->with('sibling')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($faq) {
                return [
                    'id' => $faq->unique_id,
                    'question' => $faq->question,
                    'answer' => $faq->answer,
                    'is_active' => (bool) $faq->is_active,
                    'lang' => $faq->lang,
                    'created_at' => $faq->created_at,
                    'updated_at' => $faq->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $faqs,
        ]);
    }

    public function store(StoreFaqRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $uniqueId = Str::uuid()->toString();

        $faq = Faq::create([
            'unique_id' => $uniqueId,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'is_active' => $validated['is_active'] ?? true,
            'lang' => $validated['lang'] ?? 'en',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'FAQ created successfully',
            'data' => [
                'id' => $faq->unique_id,
                'question' => $faq->question,
                'answer' => $faq->answer,
                'is_active' => (bool) $faq->is_active,
                'lang' => $faq->lang,
                'created_at' => $faq->created_at,
                'updated_at' => $faq->updated_at,
            ],
        ], 201);
    }

    public function show(string $uniqueId): JsonResponse
    {
        $faq = Faq::where('unique_id', $uniqueId)
            ->with('sibling')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $faq->unique_id,
                'question' => $faq->question,
                'answer' => $faq->answer,
                'is_active' => (bool) $faq->is_active,
                'lang' => $faq->lang,
                'created_at' => $faq->created_at,
                'updated_at' => $faq->updated_at,
            ],
        ]);
    }

    public function update(UpdateFaqRequest $request, string $uniqueId): JsonResponse
    {
        $faq = Faq::where('unique_id', $uniqueId)->firstOrFail();
        $validated = $request->validated();

        $faq->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'FAQ updated successfully',
            'data' => [
                'id' => $faq->unique_id,
                'question' => $faq->question,
                'answer' => $faq->answer,
                'is_active' => (bool) $faq->is_active,
                'lang' => $faq->lang,
                'created_at' => $faq->created_at,
                'updated_at' => $faq->updated_at,
            ],
        ]);
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $faq = Faq::where('unique_id', $uniqueId)->firstOrFail();
        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ deleted successfully',
        ]);
    }
}
