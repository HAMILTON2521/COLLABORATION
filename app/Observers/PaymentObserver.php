<?php

namespace App\Observers;

use App\Models\LorawanRechargeRequest;
use App\Models\Payment;
use App\Models\Setting;
use App\Traits\HttpHelper;

class PaymentObserver
{
    use HttpHelper;
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        $payment->lorawanRechargeRequests()->create([
            'topup_amount' => $payment->amount,
            'topup_to_device_amount' => $payment->accumulated_volume
        ]);
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        if ($payment->status == "Recharged") {
            $payment->valveControl()->create([
                'state' => 1,
                'customer_id' => $payment->customer->id,
                'source' => 'Payment'
            ]);
        }
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     */
    public function forceDeleted(Payment $payment): void
    {
        //
    }

    public function creating(Payment $payment)
    {
        $unitCost = Setting::where('key', 'UNIT_PRICE')->first()->value;

        $payment->accumulated_volume = $payment->amount / (float) $unitCost;
    }
}
