<?php

namespace App\Models;

use App\Observers\SelcomOrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(SelcomOrderObserver::class)]
class SelcomOrder extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    /**
     * Get the customer that owns the SelcomOrder
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the selcomPush associated with the SelcomOrder
     *
     * @return HasOne
     */
    public function selcomPush(): HasOne
    {
        return $this->hasOne(SelcomPush::class);
    }

    /**
     * Get the payment that owns the SelcomOrder
     *
     * @return BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
