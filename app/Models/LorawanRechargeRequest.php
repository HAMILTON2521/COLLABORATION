<?php

namespace App\Models;

use App\Observers\LorawanRechargeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(LorawanRechargeObserver::class)]
class LorawanRechargeRequest extends Model
{
    use HasUlids;

    protected $fillable = [
        'payment_id',
        'status',
        'topup_amount',
        'topup_to_device_amount',
        'error_code',
        'error_message',
        'order_id'
    ];

    /**
     * Relationship with Payment
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function getStatusColorAttribute(): string
    {
        return [
            'Success' => 'success',
            'New' => 'info',
            'Pending' => 'info',
            'Sent' => 'info',
        ][$this->status] ?? 'danger';
    }
}
