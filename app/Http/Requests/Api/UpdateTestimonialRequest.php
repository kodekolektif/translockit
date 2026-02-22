<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:2048'],
            'name' => ['sometimes', 'array'],
            'name.en' => ['nullable', 'string', 'max:255'],
            'name.es' => ['nullable', 'string', 'max:255'],
            'title' => ['sometimes', 'array'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.es' => ['nullable', 'string', 'max:255'],
            'content' => ['sometimes', 'array'],
            'content.en' => ['nullable', 'string'],
            'content.es' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
