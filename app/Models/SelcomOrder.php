<?php

namespace App\Models;

use App\Observers\SelcomOrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(SelcomOrderObserver::class)]
class SelcomOrder extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    /**
     * Get the customer that owns the SelcomOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
