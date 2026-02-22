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
            'text' => ['required_without:texts', 'string'],
            'texts' => ['required_without:text', 'array'],
            'texts.*' => ['string'],
            'target_language' => ['required', 'string', 'in:en,es,fr,de,it,pt,zh,ja,ko,ru,ar'],
        ];
    }
}
