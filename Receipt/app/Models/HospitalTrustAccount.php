<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalTrustAccount extends Model
{
    protected $table = 'hospital_trust_accounts';

    protected $fillable = ['hospital_id', 'account_code', 'account_class', 'sort_order'];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
