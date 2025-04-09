<?php

namespace App\Models;

use App\Observers\RealtimeDataObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(RealtimeDataObserver::class)]
class RealtimeData extends Model
{
    use HasUlids;

    protected $guarded = ['id'];

    /**
     * Relationshipn with Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    /**
     * Relationshipn with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
