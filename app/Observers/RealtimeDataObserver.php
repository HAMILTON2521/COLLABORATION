<?php

namespace App\Observers;

use App\Models\RealtimeData;
use App\Models\Setting;
use App\Traits\HttpHelper;

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
            'action' => 'zlMeter',
            'method' => 'queryRealTimeData',
            'apiToken' => $api_token,
            'param' => [
                'nbonetNetImei' => $realtimeData->customer->imei
            ]
        ]);

        try {
            $response = $this->sendHttpRequest(data: (string)$data);

            if ($response) {
                if ($response['errcode'] === '0') {
                    $realtimeData->update([
                        'error_code' => '0',
                        'error_message' => $response['errmsg'] ?? null,
                        'balance' => $response['data']['balance'] ?? null,
                        'battery' => $response['data']['battery'] ?? null,
                        'remaining_flow' => $response['data']['remaining flow'] ?? null,
                        'customer_name' => $response['data']['customerName'] ?? null,
                        'customer_address' => $response['data']['customerAddress'] ?? null,
                        'status' => 'Success',
                        'latitude' => $response['data']['gps'] ? $response['data']['gps']['lat'] : null,
                        'longitude' => $response['data']['gps'] ? $response['data']['gps']['lng'] : null,
                        'energy_type' => $response['data']['energyType'] ?? null,
                        'read_time' => $response['data']['readTime'] ?? null,
                        'imei' => $response['data']['nbonetNetImei'] ?? null,
                        'margin' => $response['data']['margin'] ?? null,
                        'leakage_mark' => $response['data']['leakageMark'] ?? null,
                        'valve_state' => $response['data']['valveState'] ?? null,
                        'reading' => $response['data']['reading'] ? (float)$response['data']['reading'] : null,
//                        'valve_status' => $response['data']['valveStatus'] ?? null,
//                        'temperature' => $response['data']['temperature'] ?? null,
//                        'class_mode' => $response['data']['classMode'] ?? null,
//                        'day_read_time' => $response['data']['dayReadTime'] ?? null,
//                        'month_read_time' => $response['data']['monthReadTime'] ?? null,
//                        'pay_mode' => $response['data']['payMode'] ?? null,
//                        'rssi' => null,
//                        'snr' => null,
//                        'day_consumption' => $response['data']['dayConsumption'] ?? null,
//                        'month_consumption' => $response['data']['monthConsumption'] ?? null
                    ]);
                } else {
                    $realtimeData->update([
                        'error_code' => $response['errcode'],
                        'error_message' => $response['errmsg'] ?? null,
                        'status' => 'Failed',
                    ]);
                }

            } else {
                $realtimeData->update(['status' => 'Failed']);
            }
        } catch (\Exception $exception) {
            $realtimeData->update([
                'status' => 'Failed',
                'error_message' => $exception->getMessage(),
                'error_code' => -2,
            ]);
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
