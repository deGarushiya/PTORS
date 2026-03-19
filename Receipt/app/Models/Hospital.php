<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = ['name', 'account_code', 'trust_account_code', 'general_account_code', 'sort_order'];

    public function trustAccounts()
    {
        return $this->hasMany(HospitalTrustAccount::class, 'hospital_id');
    }

    public function generalAccount()
    {
        return $this->hasOne(HospitalGeneralAccount::class, 'hospital_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
