<?php

namespace App\Http\Requests\Api;

use App\Models\ArticleCategory;
use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
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
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'title' => ['required'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.es' => ['nullable', 'string', 'max:255'],
            'content' => ['required'],
            'content.en' => ['nullable', 'string'],
            'content.es' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],
            'category_id' => ['nullable', 'string'],
            'category' => ['nullable', 'array'],
            'category.name' => ['nullable', 'string', 'max:255'],
            'category.en' => ['nullable', 'string', 'max:255'],
            'category.es' => ['nullable', 'string', 'max:255'],
            'author_id' => ['nullable', 'string'],
            'author' => ['nullable', 'array'],
            'author.name' => ['nullable', 'string', 'max:255'],
            'author.en' => ['nullable', 'string', 'max:255'],
            'author.es' => ['nullable', 'string', 'max:255'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
