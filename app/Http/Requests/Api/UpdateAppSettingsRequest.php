<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'keywords' => ['sometimes', 'string'],
            'favicon' => ['nullable', 'image', 'max:512'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'logo_dark' => ['nullable', 'image', 'max:2048'],
            'default_language' => ['sometimes', 'string', 'in:en,es'],
            'default_target_language' => ['sometimes', 'string', 'in:en,es,fr,de,it,pt,zh,ja,ko,ru,ar'],
            'translation_ai_service' => ['sometimes', 'string', 'in:gemini,openai'],
            'gemini_api_key' => ['nullable', 'string'],
            'gemini_api_url' => ['nullable', 'string', 'url'],
            'openai_api_key' => ['nullable', 'string'],
            'openai_api_url' => ['nullable', 'string', 'url'],
        ];
    }
}
