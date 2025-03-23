<?php

namespace App\Observers;

use App\Models\RealtimeData;
use App\Models\Setting;
use App\Traits\HttpHelper;
use Illuminate\Support\Facades\Log;

class RealtimeDataObserver
{
    use HttpHelper;
    /**
     * Handle the RealtimeData "created" event.
     */
    public function created(RealtimeData $realtimeData): void
    {
        $api_token = Setting::where('key', 'API_TOKEN')->first()->value;

        $data = json_encode([
            'action'  => 'lorawanMeter',
            'method'  => 'queryRealTimeData',
            'apiToken' => $api_token,
            'param'   => [
                'deveui'      => $realtimeData->customer->imei
            ]
        ]);

        $response = $this->sendHttpRequest(data: (string) $data);
        if ($response) {
            $realtimeData->update([
                'error_code' => $response['errcode'] ?? null,
                'error_message' => $response['errmsg'] ?? null,
                'balance' => $response['data']['balance'] ?? null,
                'battery' => $response['data']['battery'] ?? null,
                'status' => $response['errcode'] === "0" ? "Success" : "Failed",
                'energy_type' => $response['data']['energyType'] ?? null,
                'read_time' => $response['data']['readTime'] ?? null,
                'imei' => $response['data']['devEui'] ?? null,
                'margin' => $response['data']['margin'] ?? null,
                'leakage_mark' => $response['data']['leakageMark'] ?? null,
                'valve_state' => $response['data']['valveState'] ?? null,
                'valve_status' => $response['data']['valveStatus'] ?? null,
                'temperature' => $response['data']['temperature'] ?? null,
                'class_mode' => $response['data']['classMode'] ?? null,
                'day_read_time' => $response['data']['dayReadTime'] ?? null,
                'month_read_time' => $response['data']['monthReadTime'] ?? null,
                'pay_mode' => $response['data']['payMode'] ?? null,
                'reading' => $response['data']['reading'] ? (float) $response['data']['reading'] : null,
                'rssi' => $response['data']['rssi'] ? (float) $response['data']['rssi'] : null,
                'snr' => $response['data']['snr'] ? (float) $response['data']['snr'] : null,
                'day_consumption' => $response['data']['dayConsumption'] ?? null
            ]);
        } else {
            $realtimeData->update(['status' => 'Failed']);
        }
    }

    /**
     * Handle the RealtimeData "updated" event.
     */
    public function updated(RealtimeData $realtimeData): void
    {
        //
    }

    /**
     * Handle the RealtimeData "deleted" event.
     */
    public function deleted(RealtimeData $realtimeData): void
    {
        //
    }

    /**
     * Handle the RealtimeData "restored" event.
     */
    public function restored(RealtimeData $realtimeData): void
    {
        //
    }

    /**
     * Handle the RealtimeData "force deleted" event.
     */
    public function forceDeleted(RealtimeData $realtimeData): void
    {
        //
    }
}
