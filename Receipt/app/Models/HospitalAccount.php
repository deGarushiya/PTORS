<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalAccount extends Model
{
    protected $table = 'hospital_accounts';

    protected $fillable = ['name', 'account_code', 'sort_order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
