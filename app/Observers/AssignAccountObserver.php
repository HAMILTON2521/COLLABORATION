<?php

namespace App\Observers;

use App\Models\UserAccount;

class AssignAccountObserver
{
    /**
     * Handle the UserAccount "created" event.
     */
    public function created(UserAccount $userAccount): void
    {
        $customer = $userAccount->customer();

        if ($customer) {
            $customer->update([
                'is_assigned' => true
            ]);
        }
    }

    /**
     * Handle the UserAccount "updated" event.
     */
    public function updated(UserAccount $userAccount): void
    {
        //
    }

    /**
     * Handle the UserAccount "deleted" event.
     */
    public function deleted(UserAccount $userAccount): void
    {

        $customer = $userAccount->customer();

        if ($customer) {
            $customer->update([
                'is_assigned' => false
            ]);
        }
    }

    /**
     * Handle the UserAccount "restored" event.
     */
    public function restored(UserAccount $userAccount): void
    {
        //
    }

    /**
     * Handle the UserAccount "force deleted" event.
     */
    public function forceDeleted(UserAccount $userAccount): void
    {
        //
    }
}
