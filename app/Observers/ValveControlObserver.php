<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Setting;
use App\Models\ValveControl;
use App\Traits\HttpHelper;

class ValveControlObserver
{
    use HttpHelper;

    /**
     * Handle the ValveControl "created" event.
     */
    public function created(ValveControl $valveControl): void
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action' => 'zlMeter',
            'method' => 'setValveState',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $valveControl->customer->imei,
                'valveState' => $valveControl->state
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: (string)$data);
            if ($response) {
                $valveControl->update([
                    'error_code' => $response['errcode'],
                    'error_message' => $response['errmsg'],
                    'value_id' => $response['errcode'] === '0' ? $response['valueId'] : null
                ]);
            }
        } catch (\Exception $exception) {
            $valveControl->update([
                'error_code' => -2,
                'error_message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Handle the ValveControl "updated" event.
     */
    public function updated(ValveControl $valveControl): void
    {
        if ($valveControl->source == "Payment") {
            if ($valveControl->error_code === "0") {
                Payment::findOrFail($valveControl->payment_id)->update([
                    'status' => 'Recharged'
                ]);
            }
        }
    }

    /**
     * Handle the ValveControl "deleted" event.
     */
    public function deleted(ValveControl $valveControl): void
    {
        //
    }

    /**
     * Handle the ValveControl "restored" event.
     */
    public function restored(ValveControl $valveControl): void
    {
        //
    }

    /**
     * Handle the ValveControl "force deleted" event.
     */
    public function forceDeleted(ValveControl $valveControl): void
    {
        //
    }
}
