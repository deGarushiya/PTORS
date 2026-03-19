<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalGeneralAccount extends Model
{
    protected $table = 'hospital_general_accounts';

    protected $fillable = ['hospital_id', 'account_code', 'sort_order'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
