<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logo' => ['required', 'image', 'max:1024'],
            'brand_name' => ['required', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ];
    }
}
