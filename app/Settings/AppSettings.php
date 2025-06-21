<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public string $title;
    public string $description;
    public string $keywords;
    public ?string $favicon;
    public ?string $logo;
    public ?string $logo_dark;
    public ?string $gemini_api_key;
    public ?string $gemini_api_url;
    public string $default_language;
    // public array $supported_languages;
    public ?string $openai_api_key;
    public ?string $openai_api_url;
    public string $default_target_language;
    public string $translation_ai_service;

    public static function group(): string
    {

        return 'appSettings';
    }
}
