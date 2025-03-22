<?php

namespace App\Models;

use App\Observers\LorawanRechargeObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

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
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
