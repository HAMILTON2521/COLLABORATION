<?php

namespace App\Models;

use App\Observers\IncomingRequestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(IncomingRequestObserver::class)]
class IncomingRequest extends Model
{
    use HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    /**
     * Relationship with Payment model
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'internal_txn_id', 'id');
    }
    public function selcomMerchantPayment(): BelongsTo
    {
        return $this->belongsTo(SelcomMerchantPayment::class);
    }
}
