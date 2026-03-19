<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payor extends Model
{
    protected $table = 'payors';

    protected $fillable = ['name', 'sort_order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
