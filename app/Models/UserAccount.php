<?php

namespace App\Models;

use App\Observers\AssignAccountObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(AssignAccountObserver::class)]
class UserAccount extends Model
{
    use HasUlids;

    protected $fillable = ['customer_id', 'user_id'];

    /**
     * Relationship with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Customer model
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
