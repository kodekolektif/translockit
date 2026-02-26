<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tags' => 'array', // Cast tags to an array
        'published_at' => 'datetime', // Cast published_at to a datetime object
    ];

     public function sibling()
    {
        return $this->hasOne(Article::class, 'unique_id', 'unique_id')
            ->where('lang', '!=', $this->lang);
    }

    public function isPublished(): Attribute
    {
         return Attribute::make(
            get: fn ($value) => (bool) $value,
            set: fn ($value) => (bool) $value,
        );
    }

    public function category(): HasOne
    {
        return $this->hasOne(ArticleCategory::class, 'unique_id', 'category_id')->where('lang', 'en');
    }

    public function author(): HasOne
    {
        return $this->hasOne(Author::class, 'unique_id', 'author_id')->where('lang', 'en');
    }

    public function getLocalizedCategory()
    {
        return $this->category()->where('lang', app()->getLocale())->first();
    }

    protected function englishCategory(): Attribute
    {
        return Attribute::get(function () {
            return DB::table('article_categories')
                ->where('unique_id', $this->category_id)
                ->where('lang', 'en')
                ->first();
        });
    }

    protected function englishAuthor(): Attribute
    {
        return Attribute::get(function () {
            return DB::table('authors')
                ->where('unique_id', $this->author_id)
                ->where('lang', 'en')
                ->first();
        });
    }

}
