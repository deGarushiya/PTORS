<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'office_id',
        'issued_by',
        'payer_name',
        'amount',
        'payment_method',
        'check_bank_name',
        'check_number',
        'check_date',
        'description',
        'notes',
        'receipt_date',
        'status',
        'cancelled_at',
        'cancelled_reason',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'receipt_date' => 'date',
            'check_date' => 'date',
            'cancelled_at' => 'datetime',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
}
