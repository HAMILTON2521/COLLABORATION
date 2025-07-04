<?php

namespace App\Models;

use App\Observers\ValveControlObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[ObservedBy(ValveControlObserver::class)]
class ValveControl extends Model
{
    use HasUlids;

    protected $fillable = [
        'source',
        'user_id',
        'error_code',
        'error_message',
        'state',
        'customer_id',
        'value_id',
        'payment_id'
    ];

    /**
     * Relationship with Customer model
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship with Payment model
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * User who changed valve state, in case of Manual
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('value_id', 'LIKE', "%{$term}%")
            ->orWhereHas('customer', function ($query) use ($term) {
                $query->where('first_name', 'LIKE', "%{$term}%")
                    ->orWhere('last_name', 'LIKE', "%{$term}%")
                    ->orWhere('imei', 'LIKE', "%{$term}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$term}%"]);
            });
    }

    public function getStatusColorAttribute(): string
    {
        return [
            '0' => 'success'
        ][$this->error_code] ?? 'danger';
    }

    protected function txnId(): Attribute
    {
        return Attribute::make(
            get: fn() => Str::upper(Str::substr($this->id, 0, 10))
        );
    }
}
