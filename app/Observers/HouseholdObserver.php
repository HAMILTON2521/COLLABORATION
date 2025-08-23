<?php

namespace App\Observers;

use App\Models\Household;
use App\Models\Setting;
use App\Traits\HttpHelper;

class HouseholdObserver
{
    use HttpHelper;

    /**
     * Handle the Household "created" event.
     */
    public function created(Household $household): void
    {
        if ($household->status === 'Pending') {
            $api_token = Setting::where('key', 'API_TOKEN')->first()->value;
            $areaId = Setting::where('key', 'BACKEND_AREA_ID')->first()->value;

            $data = json_encode([
                'action' => 'zlMeter',
                'method' => 'addHousehold',
                'apiToken' => $api_token,
                'params' => [
                    'areaId' => $areaId,
                    'householdName' => $household->name,
                    'householdAddress' => $household->address,
                    'householdPhone' => $household->phone,
                    'householdPassword' => $household->password,
                    'householdWarnMoney' => $household->warn_money,
                    'householdFee' => $household->fee
                ]
            ]);

            $response = $this->sendHttpRequest(data: (string)$data);

            if ($response['errcode'] === '0') {
                $household->update([
                    'status' => 'Completed',
                    'household_number' => $response['householdId'],
                ]);
            }
        }
    }

    /**
     * Handle the Household "updated" event.
     */
    public function updated(Household $household): void
    {
        //
    }

    /**
     * Handle the Household "deleted" event.
     */
    public function deleted(Household $household): void
    {
        //
    }

    /**
     * Handle the Household "restored" event.
     */
    public function restored(Household $household): void
    {
        //
    }

    /**
     * Handle the Household "force deleted" event.
     */
    public function forceDeleted(Household $household): void
    {
        //
    }
}
