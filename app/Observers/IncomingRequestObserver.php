<?php

namespace App\Observers;

use App\Models\IncomingRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class IncomingRequestObserver
{
    /**
     * Handle the incomingRequest "created" event.
     */
    public function created(IncomingRequest $incomingRequest): void
    {
        if (
            (
                $incomingRequest->request === "Payment Callback" ||
                in_array($incomingRequest->channel, ["Manual", "Selcom"])
            ) &&
            $incomingRequest->status === "Success"
        ) {
            Payment::create([
                'customer_id'    => $incomingRequest->customer_id,
                'msisdn'         => $incomingRequest->customer_msisdn,
                'channel'        => $incomingRequest->channel,
                'amount'         => $incomingRequest->amount,
                'status'         => 'Received',
                'external_id'    => $incomingRequest->reference_1,
                'internal_txn_id' => $incomingRequest->id
            ]);
        }
    }

    /**
     * Handle the incomingRequest "updated" event.
     */
    public function updated(IncomingRequest $incomingRequest): void
    {
        //
    }

    /**
     * Handle the incomingRequest "deleted" event.
     */
    public function deleted(IncomingRequest $incomingRequest): void
    {
        //
    }

    /**
     * Handle the incomingRequest "restored" event.
     */
    public function restored(IncomingRequest $incomingRequest): void
    {
        //
    }

    /**
     * Handle the incomingRequest "force deleted" event.
     */
    public function forceDeleted(IncomingRequest $incomingRequest): void
    {
        //
    }
}
