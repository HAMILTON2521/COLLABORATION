<?php

namespace App\Models;

use App\Observers\ValveControlObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

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
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    /**
     * Relationship with Payment model
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * User who changed valve state, in case of Manual
     */
    public function user()
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

    public function getStatusColorAttribute()
    {
        return [
            '0' => 'success'
        ][$this->error_code] ?? 'danger';
    }
}
