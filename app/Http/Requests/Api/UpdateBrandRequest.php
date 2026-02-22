<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logo' => ['nullable', 'image', 'max:1024'],
            'brand_name' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ];
    }
}
