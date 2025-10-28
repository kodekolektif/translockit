<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];
    public function sibling()
    {
        return $this->hasOne(Author::class, 'unique_id', 'unique_id')
            ->where('lang', '!=', $this->lang);
    }

}
