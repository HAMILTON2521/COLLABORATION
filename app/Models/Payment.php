<?php

namespace App\Models;

use App\Observers\PaymentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy(PaymentObserver::class)]
class Payment extends Model
{
    use HasFactory, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'amount',
        'internal_txn_id',
        'status',
        'customer_id',
        'external_id',
        'msisdn',
        'channel',
        'accumulated_volume'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::ulid()->toBase32();
            }
        });
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

    public function getStatusColorAttribute()
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

    public function airtelRequest()
    {
        return $this->belongsTo(AirtelRequest::class, 'internal_txn_id');
    }

    /**
     * The customer making the payment (nullable)
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    /**
     * Relationship with LorawanRechargeRequest
     */
    public function lorawanRechargeRequests()
    {
        return $this->hasMany(LorawanRechargeRequest::class);
    }

    /**
     * Relationship with ValveControl model
     */
    public function valveControl()
    {
        return $this->hasOne(ValveControl::class);
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
}
