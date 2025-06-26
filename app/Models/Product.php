<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Product extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'unique_id';
    }
    public function sibling()
    {
        return $this->hasOne(self::class, 'unique_id', 'unique_id')
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
