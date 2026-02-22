<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['sometimes', 'array'],
            'name.en' => ['nullable', 'string', 'max:255'],
            'name.es' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
