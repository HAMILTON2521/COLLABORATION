<?php

namespace App\Observers;

use App\Mail\UserCreated;
use App\Models\User;
use App\Models\UserVerification;
use App\Traits\GeneralHelperTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    use GeneralHelperTrait;
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        UserVerification::create([
            'user_id' => $user->id,
            'key' => $this->generateJWTToken(
                key: env('JWT_SECRET'),
                iss: config('app.name'),
                sub: config('app.name'),
                jwtExpiryInSeconds: (int) env('JWT_EXPIRY_SECONDS'),
                uniqueId: $user->id
            ),
            'expire_date' => Carbon::now()->addMinutes((int) env('JWT_EXPIRY_SECONDS'))
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
