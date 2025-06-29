<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'unique_id';
    }
    public function sibling()
    {
        return $this->hasOne(Project::class, 'unique_id', 'unique_id')
            ->where('lang', '!=', $this->lang);
    }


    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (bool) $value,
            set: fn ($value) => (bool) $value,
        );
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'unique_id');
    }
}
