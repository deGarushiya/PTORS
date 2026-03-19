<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    protected $table = 'bank_branches';

    protected $fillable = ['bank_id', 'name', 'sort_order'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
