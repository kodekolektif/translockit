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
            'title' => ['required', 'array'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.es' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'array'],
            'content.en' => ['nullable', 'string'],
            'content.es' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],
            'category_id' => ['nullable', 'exists:article_categories,unique_id'],
            'author_id' => ['nullable', 'exists:authors,unique_id'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'lang' => ['string', 'in:en,es'],
        ];
    }
}
