<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'lang',
        'unique_id',
        'icon', // ✅ PASTIKAN BARIS INI ADA. INI KEMUNGKINAN BESAR ADALAH MASALAHNYA.
        'title',
        'description',
        'is_active',
    ];

    public $timestamps = true;

    public function getRouteKeyName()
    {
        return 'unique_id';
    }
    public function sibling()
    {
        return $this->hasOne(Service::class, 'unique_id', 'unique_id')
            ->where('lang', '!=', $this->lang);
    }
//    public function getIconAttribute($value)
//     {
//         // Assuming the icon is stored as a URL or path
//        return $value ? 'storage/service-icons/' . $value : null;
//     }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (bool) $value,
            set: fn ($value) => (bool) $value,
        );
    }
}
