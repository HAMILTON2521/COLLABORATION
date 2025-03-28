<?php

namespace App\Models;

use App\Observers\PushRequestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(PushRequestObserver::class)]
class PushRequest extends Model
{
    use HasUlids;
    protected $guarded = ['id'];

    /**
     * Relationship with Customer model
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
