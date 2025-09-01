<?php

namespace App\Models;

use App\Observers\PaymentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

#[ObservedBy(PaymentObserver::class)]
class Payment extends Model
{
    use  HasUlids;

    protected $guarded = ['id'];

    public function getStatusColorAttribute(): string
    {
        return [
            'Received' => 'warning',
            'Success' => 'success',
            'Recharged' => 'info'
        ][$this->status] ?? 'danger';
    }

    /**
     * Relationships
     */

    public function incomingRequest(): BelongsTo
    {
        return $this->belongsTo(IncomingRequest::class, 'internal_txn_id');
    }

    /**
     * The customer making the payment (nullable)
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship with LorawanRechargeRequest
     */
    public function lorawanRechargeRequests(): HasMany
    {
        return $this->hasMany(LorawanRechargeRequest::class);
    }

    /**
     * Relationship with ValveControl model
     */
    public function valveControl(): HasOne
    {
        return $this->hasOne(ValveControl::class);
    }

    /**
     * Get the selcomOrder associated with the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function selcomOrder(): HasOne
    {
        return $this->hasOne(SelcomOrder::class);
    }

    /**
     * Scope for user search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('customer_id', 'LIKE', "%{$term}%")
            ->orWhere('msisdn', 'LIKE', "%{$term}%")
            ->orWhere('internal_txn_id', 'LIKE', "%{$term}%")
            ->orWhere('channel', 'LIKE', "%{$term}%")
            ->orWhere('external_id', 'LIKE', "%{$term}%");
    }

    protected function txnId(): Attribute
    {
        return Attribute::make(
            get: fn() => Str::upper(Str::substr($this->internal_txn_id ?? '-', 0, 10))
        );
    }

    protected function formattedAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => number_format($this->amount, 0)
        );
    }
}
