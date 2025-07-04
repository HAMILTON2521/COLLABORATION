<?php

namespace App\Models;

use App\Observers\SelcomPushObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(SelcomPushObserver::class)]
class SelcomPush extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    /**
     * Get the selcom order that owns the SelcomPush
     *
     * @return BelongsTo
     */
    public function selcomOrder(): BelongsTo
    {
        return $this->belongsTo(SelcomOrder::class);
    }
}
