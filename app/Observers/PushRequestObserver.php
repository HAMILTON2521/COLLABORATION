<?php

namespace App\Observers;

use App\Models\IncomingRequest;
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

            $data = [
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
            ];

            $response = $this->sendAirtelUssdPush($data, $endpoint);
            if ($response) {
                if ($response->status() === 200) {
                    $transaction = $response->json();
                    if ($transaction['data'] && $transaction['status']['code'] == "200") {
                        PushRequest::find($transaction['data']['transaction']['id'])
                            ->update([
                                'status' => 'Pending',
                                'mno_response_code' => $transaction['status']['response_code'],
                                'mno_error_code' => $transaction['status']['code'],
                                'mno_status' => $transaction['data']['transaction']['status'],
                                'mno_result_code' => $transaction['status']['result_code'],
                                'mno_message' => $transaction['status']['message']
                            ]);
                    } else {
                        PushRequest::find($transaction['data']['transaction']['id'])
                            ->update([
                                'status' => 'Failed',
                                'mno_response_code' => $transaction['status']['response_code'],
                                'mno_error_code' => $transaction['status']['code'],
                                'mno_status' => 'Failed',
                                'mno_result_code' => $transaction['status']['result_code'],
                                'mno_message' => $transaction['status']['message']
                            ]);
                    }
                } else {
                    $pushRequest->update([
                        'status' => 'Failed'
                    ]);
                }
            } else {
                $pushRequest->update([
                    'status' => 'Failed'
                ]);
            }
        }
    }

    /**
     * Handle the PushRequest "updated" event.
     */
    public function updated(PushRequest $pushRequest): void
    {
        if ($pushRequest->status == "Success") {
            IncomingRequest::create([
                'request' => 'Payment Callback',
                'customer_msisdn' => $pushRequest->phone,
                'amount' => $pushRequest->amount,
                'status' => $pushRequest->status,
                'type' => 'C2B',
                'error_message' => $pushRequest->mno_message,
                'customer_id' => $pushRequest->customer_id,
                'reference_1' => $pushRequest->mno_txn_id
            ]);
        }
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
