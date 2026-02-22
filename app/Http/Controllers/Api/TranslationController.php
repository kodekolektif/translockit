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
     * Translate text to a target language.
     */
    public function translate(TranslateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $text = $validated['text'];
        $targetLanguage = $validated['target_language'];

        try {
            $translatedText = TranslationService::translate($text, $targetLanguage);

            return response()->json([
                'success' => true,
                'data' => [
                    'original_text' => $text,
                    'translated_text' => $translatedText,
                    'target_language' => $targetLanguage,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Translation failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Translate multiple texts at once.
     */
    public function batchTranslate(TranslateRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $texts = $validated['texts'];
        $targetLanguage = $validated['target_language'];

        $translations = [];

        try {
            foreach ($texts as $text) {
                $translations[] = [
                    'original_text' => $text,
                    'translated_text' => TranslationService::translate($text, $targetLanguage),
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'translations' => $translations,
                    'target_language' => $targetLanguage,
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
