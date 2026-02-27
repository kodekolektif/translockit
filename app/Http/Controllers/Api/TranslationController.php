<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TranslateRequest;
use App\Services\Translation as TranslationService;
use Illuminate\Http\JsonResponse;

/**
 * @tags Translation
 */
class TranslationController extends Controller
{
    /**
     * Translate multiple texts at once.
     */
    public function translate(TranslateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $targetLanguage = $validated['target_lang'];

        $translations = [];

        try {
            foreach ($validated['data'] as $item) {
                $translations[] = [
                    'key' => $item['key'],
                    'original_text' => $item['value'],
                    'translated_text' => TranslationService::translate($item['value'], $targetLanguage),
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'translations' => $translations,
                    'target_lang' => $targetLanguage,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Translation failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
