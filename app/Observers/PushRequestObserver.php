<?php

namespace App\Observers;

use App\Models\PushRequest;
use App\Models\Setting;
use App\Traits\HttpHelper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PushRequestObserver
{
    use HttpHelper;
    /**
     * Handle the PushRequest "created" event.
     */
    public function created(PushRequest $pushRequest): void
    {
        if ($pushRequest->status === 'New') {

            $url = Setting::where('key', App::environment('production') ? 'AIRTEL_C2B_PROD_USSD_PUSH_URL' : 'AIRTEL_C2B_UAT_USSD_PUSH_URL')->first()->value;
            $endpoint = $url . 'merchant/v1/payments/';

            $data = json_encode([
                'reference' => $pushRequest->customer->ref,
                'subscriber' => [
                    'country' => 'TZ',
                    'currency' => 'TZS',
                    'msisdn' => substr($pushRequest->phone, 1, 9)
                ],
                'transaction' => [
                    'amount' => (int) $pushRequest->amount,
                    'country' => 'TZ',
                    'currency' => 'TZS',
                    'id' => $pushRequest->id
                ]
            ]);

            $response = $this->sendAirtelUssdPush($data, $endpoint);
        }
    }

    /**
     * Handle the PushRequest "updated" event.
     */
    public function updated(PushRequest $pushRequest): void
    {
        //
    }

    /**
     * Handle the PushRequest "deleted" event.
     */
    public function deleted(PushRequest $pushRequest): void
    {
        //
    }

    /**
     * Handle the PushRequest "restored" event.
     */
    public function restored(PushRequest $pushRequest): void
    {
        //
    }

    /**
     * Handle the PushRequest "force deleted" event.
     */
    public function forceDeleted(PushRequest $pushRequest): void
    {
        //
    }
}
