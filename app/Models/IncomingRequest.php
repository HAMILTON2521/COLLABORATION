<?php

namespace App\Models;

use App\Observers\IncomingRequestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(IncomingRequestObserver::class)]
class IncomingRequest extends Model
{
    use HasFactory, HasUlids;

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
}
