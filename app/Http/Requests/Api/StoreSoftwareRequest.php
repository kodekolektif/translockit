<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoftwareRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logo' => ['required', 'image', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.es' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
