<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TranslateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Structured batch translation (array of key-value pairs)
            'data' => ['required_without:text,texts', 'array'],
            'data.*.key' => ['required', 'string'],
            'data.*.value' => ['required', 'string'],
            // Target language
            'target_lang' => ['required', 'string', 'in:en,es,fr,de,it,pt,zh,ja,ko,ru,ar'],
        ];
    }
}
