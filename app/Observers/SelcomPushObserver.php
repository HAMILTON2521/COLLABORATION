<?php

namespace App\Observers;

use App\Models\SelcomPush;

class SelcomPushObserver
{
    /**
     * Handle the SelcomPush "created" event.
     */
    public function created(SelcomPush $selcomPush): void
    {
        //
    }

    /**
     * Handle the SelcomPush "updated" event.
     */
    public function updated(SelcomPush $selcomPush): void
    {
        if ($selcomPush->is_paid) {
            $selcomPush->selcomOrder->customer->incomingRequests()->create([
                'amount' => $selcomPush->amount_paid,
                'type' => 'Payment',
                'request' => 'Process',
                'channel' => 'Selcom',
                'reference' => $selcomPush->selcomOrder->customer->ref,
                'reference_1' => $selcomPush->external_id,
                'status' => 'Success',
                'customer_msisdn' => $selcomPush->selcomOrder->phone,
                'customer_name' => $selcomPush->selcomOrder->customer->full_name,
                'customer_id' => $selcomPush->selcomOrder->customer_id,
            ]);
        }
    }

    /**
     * Handle the SelcomPush "deleted" event.
     */
    public function deleted(SelcomPush $selcomPush): void
    {
        //
    }

    /**
     * Handle the SelcomPush "restored" event.
     */
    public function restored(SelcomPush $selcomPush): void
    {
        //
    }

    /**
     * Handle the SelcomPush "force deleted" event.
     */
    public function forceDeleted(SelcomPush $selcomPush): void
    {
        //
    }
}
