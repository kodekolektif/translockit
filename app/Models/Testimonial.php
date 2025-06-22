<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Testimonial extends Model
{
    protected $fillable = [
        'lang',
        'unique_id',
        'name',
        'title',
        'content',
        'image',
        'is_active',
    ];


    public function getRouteKeyName()
    {
        return 'unique_id';
    }
    public function sibling()
    {
        return $this->hasOne(Testimonial::class, 'unique_id', 'unique_id')
            ->where('lang', '!=', $this->lang);
    }
    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (bool) $value,
            set: fn ($value) => (bool) $value,
        );
    }
}
