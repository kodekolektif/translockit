<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
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
