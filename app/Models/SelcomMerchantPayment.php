<?php

namespace App\Models;

use App\Observers\SelcomMerchantPaymentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(SelcomMerchantPaymentObserver::class)]
class SelcomMerchantPayment extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);

    }
    public function incomingRequest(): HasOne
    {
        return $this->hasOne(IncomingRequest::class);
    }
}
