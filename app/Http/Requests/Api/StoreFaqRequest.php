<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'array'],
            'question.en' => ['nullable', 'string', 'max:255'],
            'question.es' => ['nullable', 'string', 'max:255'],
            'answer' => ['required', 'array'],
            'answer.en' => ['nullable', 'string'],
            'answer.es' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
