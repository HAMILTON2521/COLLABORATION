<?php

namespace App\Observers;

use App\Models\LorawanRechargeRequest;
use App\Models\Payment;
use App\Models\Setting;
use App\Traits\HttpHelper;

class LorawanRechargeObserver
{
    use HttpHelper;

    /**
     * Handle the LorawanRechargeRequest "created" event.
     */
    public function created(LorawanRechargeRequest $lorawanRechargeRequest): void
    {
        $send_to_lorawan = (int) Setting::get('SEND_TO_LORAWAN');
        $api_token = Setting::get('API_TOKEN');

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'remotelyTopUp',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $lorawanRechargeRequest->payment->customer->imei,
                'topUpToDeviceAmount' => $lorawanRechargeRequest->topup_to_device_amount,
                'topUpAmount' => $lorawanRechargeRequest->topup_amount
            ]
        ]);

        if ($send_to_lorawan) {

            $response = $this->sendHttpRequest(data: (string) $data);

            if ($response) {
                $lorawanRechargeRequest->update([
                    'error_code' => $response['errcode'],
                    'error_message' => $response['errmsg'],
                    'order_id' => $response['orderId'],
                    'status' => $response['errcode'] === "0" ? "Success" : "Failed"
                ]);
            }
        } else {
            info('Sending requests to Lorawan is disabled');
        }
    }

    /**
     * Handle the LorawanRechargeRequest "updated" event.
     */
    public function updated(LorawanRechargeRequest $lorawanRechargeRequest): void
    {
        Payment::findOrFail($lorawanRechargeRequest->payment_id)->update([
            'status' => $lorawanRechargeRequest->error_code === "0" ? "Recharged" : "Failed"
        ]);
    }

    /**
     * Handle the LorawanRechargeRequest "deleted" event.
     */
    public function deleted(LorawanRechargeRequest $lorawanRechargeRequest): void
    {
        //
    }

    /**
     * Handle the LorawanRechargeRequest "restored" event.
     */
    public function restored(LorawanRechargeRequest $lorawanRechargeRequest): void
    {
        //
    }

    /**
     * Handle the LorawanRechargeRequest "force deleted" event.
     */
    public function forceDeleted(LorawanRechargeRequest $lorawanRechargeRequest): void
    {
        //
    }
}
