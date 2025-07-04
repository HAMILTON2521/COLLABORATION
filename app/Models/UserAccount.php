<?php

namespace App\Models;

use App\Observers\AssignAccountObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

#[ObservedBy(AssignAccountObserver::class)]
class UserAccount extends Model
{
    use HasUlids;

    protected $fillable = ['customer_id', 'user_id'];

    /**
     * The user assigned to the customer
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The customer assigned to the user
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(
            Payment::class,
            Customer::class,
            'id',
            'customer_id',
            'customer_id',
            'id'
        );
    }
}
