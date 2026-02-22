<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'description' => ['sometimes', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.es' => ['nullable', 'string'],
            'service_id' => ['nullable', 'exists:services,unique_id'],
            'is_active' => ['boolean'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
