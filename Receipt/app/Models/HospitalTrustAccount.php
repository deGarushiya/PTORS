<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalTrustAccount extends Model
{
    protected $table = 'hospital_trust_accounts';

    protected $fillable = ['hospital_id', 'name', 'account_code', 'sort_order'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
