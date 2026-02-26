<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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
            'profile' => ['nullable', 'image', 'max:2048'],
            'name' => ['sometimes', 'string', 'max:255'],
            'title' => ['sometimes', 'array'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.es' => ['nullable', 'string', 'max:255'],
            'description' => ['sometimes', 'array'],
            'description.en' => ['nullable', 'string'],
            'description.es' => ['nullable', 'string'],
            'social_links' => ['nullable', 'array'],
            'social_facebook' => ['nullable', 'url'],
            'social_twitter' => ['nullable', 'url'],
            'social_linkedin' => ['nullable', 'url'],
            'social_instagram' => ['nullable', 'url'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
