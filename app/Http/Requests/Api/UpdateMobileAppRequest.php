<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMobileAppRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:2048'],
            'title' => ['sometimes', 'array'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.es' => ['nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.es' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
