<?php

namespace App\Observers;

use App\Models\SelcomMerchantPayment;

class SelcomMerchantPaymentObserver
{
    /**
     * Handle the SelcomMerchantPayment "created" event.
     */
    public function created(SelcomMerchantPayment $selcomMerchantPayment): void
    {
        $selcomMerchantPayment->customer->incomingRequests()->create([
            'amount' => $selcomMerchantPayment->amount,
            'type' => 'Payment',
            'request' => 'Payment Callback',
            'channel' => 'Selcom',
            'status' => 'Success',
            'customer_msisdn' => $selcomMerchantPayment->msisdn,
            'reference_1' => $selcomMerchantPayment->transid,
            'reference' => $selcomMerchantPayment->customer->ref,
            'selcom_merchant_payment_id' => $selcomMerchantPayment->id,
        ]);
    }

    /**
     * Handle the SelcomMerchantPayment "updated" event.
     */
    public function updated(SelcomMerchantPayment $selcomMerchantPayment): void
    {
        //
    }

    /**
     * Handle the SelcomMerchantPayment "deleted" event.
     */
    public function deleted(SelcomMerchantPayment $selcomMerchantPayment): void
    {
        //
    }

    /**
     * Handle the SelcomMerchantPayment "restored" event.
     */
    public function restored(SelcomMerchantPayment $selcomMerchantPayment): void
    {
        //
    }

    /**
     * Handle the SelcomMerchantPayment "force deleted" event.
     */
    public function forceDeleted(SelcomMerchantPayment $selcomMerchantPayment): void
    {
        //
    }
}
