<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreMobileAppRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'max:2048'],
            'title' => ['required', 'array'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.es' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.es' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
