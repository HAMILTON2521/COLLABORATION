<?php

namespace App\Observers;

use App\Models\AirtelRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class AirtelRequestObserver
{
    /**
     * Handle the AirtelRequest "created" event.
     */
    public function created(AirtelRequest $airtelRequest): void
    {
        if ($airtelRequest->request == "Payment Callback" && $airtelRequest->status == "Success") {
            Payment::create([
                'customer_id' => $airtelRequest->customer_id,
                'msisdn' => $airtelRequest->customer_msisdn,
                'channel' => 'Airtel',
                'amount' => $airtelRequest->amount,
                'status' => 'Received',
                'external_id' => $airtelRequest->reference_1,
                'internal_txn_id' => $airtelRequest->id
            ]);
        }
    }

    /**
     * Handle the AirtelRequest "updated" event.
     */
    public function updated(AirtelRequest $airtelRequest): void
    {
        //
    }

    /**
     * Handle the AirtelRequest "deleted" event.
     */
    public function deleted(AirtelRequest $airtelRequest): void
    {
        //
    }

    /**
     * Handle the AirtelRequest "restored" event.
     */
    public function restored(AirtelRequest $airtelRequest): void
    {
        //
    }

    /**
     * Handle the AirtelRequest "force deleted" event.
     */
    public function forceDeleted(AirtelRequest $airtelRequest): void
    {
        //
    }
}
