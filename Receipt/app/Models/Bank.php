<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['name', 'sort_order'];

    public function branches()
    {
        return $this->hasMany(BankBranch::class, 'bank_id')->orderBy('sort_order')->orderBy('name');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
