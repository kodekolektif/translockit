<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

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
}
