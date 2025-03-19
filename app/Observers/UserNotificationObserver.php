<?php

namespace App\Observers;

use App\Mail\NotifyCreatedUser;
use App\Models\User;
use App\Models\UserVerification;
use Illuminate\Support\Facades\Mail;

class UserNotificationObserver
{
    /**
     * Handle the UserVerification "created" event.
     */
    public function created(UserVerification $userVerification): void
    {
        $user = User::findOrFail($userVerification->user_id);

        Mail::to($user)->send(new NotifyCreatedUser($user));
    }

    /**
     * Handle the UserVerification "updated" event.
     */
    public function updated(UserVerification $userVerification): void
    {
        //
    }

    /**
     * Handle the UserVerification "deleted" event.
     */
    public function deleted(UserVerification $userVerification): void
    {
        //
    }

    /**
     * Handle the UserVerification "restored" event.
     */
    public function restored(UserVerification $userVerification): void
    {
        //
    }

    /**
     * Handle the UserVerification "force deleted" event.
     */
    public function forceDeleted(UserVerification $userVerification): void
    {
        //
    }
}
