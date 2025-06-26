<?php

namespace App\Services;

use App\Libs\GeminiAI;
use App\Libs\OpenAI;
use App\Settings\AppSettings;

/**
 * Class Translation.
 */
class Translation
{
    private $defaultTranslationAIService;
    private $defaultLanguage;

    public function __construct()
    {
        $appSettings = app(AppSettings::class);
        // Initialize with settings from AppSettings
        $this->defaultTranslationAIService = $appSettings->translation_ai_service ?? 'gemini';
        $this->defaultLanguage = $appSettings->default_language ?? 'en'; // Default to English

    }

    public static function translate($text, $targetLanguage = 'es')
    {
        $appSettings = app(AppSettings::class);
        $translationService = new self();

        // Use the default translation AI service
        if ($translationService->defaultTranslationAIService === 'openai') {
            $openAI = new OpenAI($appSettings);
            return $openAI->translate($text, $targetLanguage);
        } elseif ($translationService->defaultTranslationAIService === 'gemini') {
            $geminiAI = new GeminiAI($appSettings);
            return $geminiAI->translate($text, $targetLanguage);
        }

        throw new \Exception('Unsupported translation AI service: ' . $translationService->defaultTranslationAIService);
    }
}
