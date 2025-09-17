<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\SelcomOrder;
use App\Models\SelcomPush;
use App\Models\Setting;
use App\Models\SmsSetting;
use App\Traits\HttpHelper;
use App\Traits\SmsHelper;
use Illuminate\Support\Number;

class PaymentObserver
{
    use HttpHelper, SmsHelper;

    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        $payment->lorawanRechargeRequests()->create([
            'topup_amount' => $payment->amount,
            'topup_to_device_amount' => $payment->accumulated_volume
        ]);
        $this->sendPaymentSms($payment);

        $push = SelcomPush::where('external_id', $payment->external_id)->first();
        if ($push) {
            SelcomOrder::find($push->selcom_order_id)->update([
                'is_paid' => true,
                'payment_id' => $payment->id
            ]);
        }
        $merchantPayment = $payment->incomingRequest->selcomMerchantPayment();
        if ($merchantPayment) {
            $merchantPayment->update(['status' => 'Success']);
        }
    }

    public function sendPaymentSms(Payment $payment): void
    {
        $send_sms = (int) SmsSetting::get('SEND_SMS');

        $data = [
            'firstName' => $payment->customer->first_name,
            'lastName' => $payment->customer->last_name,
            'fullName' => $payment->customer->full_name,
            'amount' => $payment->amount,
            'account' => $payment->customer->account,
            'volume' => $payment->accumulated_volume,
            'activity' => 'Payment_Received',
            'phone' => $payment->customer->phone
        ];
        if ($send_sms) {

            $message = $this->getTemplate($data);
            if ($message) {
                $phone = '255' . substr($payment->customer->phone, 1, 9);
                $this->sendNormalSms(msg: $message, phone: $phone);
            }
        } else {
            info('Payment_Received SMS could not be sent -  SEND SMS is disabled');
        }
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

        $payment->accumulated_volume = Number::format($payment->amount / (float) $unitCost, 2);
    }
}
