<?php

namespace App\Models;

use App\Observers\UserNotificationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(UserNotificationObserver::class)]
class UserVerification extends Model
{
    use HasUlids;

    protected $fillable = [
        'user_id',
        'key',
        'is_active',
        'expire_date'
    ];

    /**
     * Relationship with user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
