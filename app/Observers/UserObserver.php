<?php

namespace App\Observers;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserVerification;
use App\Traits\GeneralHelperTrait;
use Carbon\Carbon;

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
                key: Setting::where('key', 'JWT_SECRET')->first()->value,
                iss: config('app.name'),
                sub: config('app.name'),
                jwtExpiryInSeconds: (int) Setting::where('key', 'JWT_EXPIRY_SECONDS')->first()->value,
                uniqueId: $user->id
            ),
            'expire_date' => Carbon::now()->addSeconds((int) Setting::where('key', 'JWT_EXPIRY_SECONDS')->first()->value)
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
