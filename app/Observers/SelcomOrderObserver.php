<?php

namespace App\Observers;

use App\Models\SelcomOrder;
use App\Models\SelcomPush;
use App\Traits\SelcomHelperTrait;

class SelcomOrderObserver
{
    use SelcomHelperTrait;
    /**
     * Handle the SelcomOrder "created" event.
     */
    public function created(SelcomOrder $selcomOrder): void
    {
        if ($selcomOrder->status === 'New') {
            $order = $this->createMinimumOrder($selcomOrder);
            if ($order && $order['resultcode']) {
                $selcomOrder->update([
                    'status' => $order['resultcode'] === '000' ? 'Success' : 'Failed',
                    'reference' => $order['reference'],
                    'resultcode' => $order['resultcode'],
                    'result' => $order['result'],
                    'message' => $order['message'],
                    'payment_token' => $order['data']['payment_token'] ?? null,
                    'payment_gateway_url' => $order['data']['payment_gateway_url'] ?? null,
                ]);
            }
        }
        if ($selcomOrder->status === 'Success') {
            $response = $this->c2b($selcomOrder);

            if ($response && $response['resultcode']) {
                SelcomPush::create([
                    'status' => $response['resultcode'] === '000' ? 'Success' : 'Failed',
                    'reference' => $response['reference'],
                    'message' => $response['message'],
                    'resultcode' => $response['resultcode'],
                    'result' => $response['result'],
                    'selcom_order_id' => $response['transid'],
                ]);
            }
            //info('C2B response', ['resp' => $response]);
            // $selcomOrder->customer->incomingReequests()->create([
            //     'amount' => $selcomOrder->amount,
            //     'type' => 'Payment',
            //     'request' => 'Process',
            //     'channel' => 'Selcom',
            //     'reference' => $selcomOrder->customer->ref,
            //     'reference_1' => $selcomOrder->reference,
            //     'status' => 'Success',
            //     'customer_msisdn' => $selcomOrder->phone,
            //     'customer_name' => $selcomOrder->customer->full_name,
            //     'customer_id' => $selcomOrder->customer_id,
            // ]);
        }
    }

    /**
     * Handle the SelcomOrder "updated" event.
     */
    public function updated(SelcomOrder $selcomOrder): void
    {
        //
    }

    /**
     * Handle the SelcomOrder "deleted" event.
     */
    public function deleted(SelcomOrder $selcomOrder): void
    {
        //
    }

    /**
     * Handle the SelcomOrder "restored" event.
     */
    public function restored(SelcomOrder $selcomOrder): void
    {
        //
    }

    /**
     * Handle the SelcomOrder "force deleted" event.
     */
    public function forceDeleted(SelcomOrder $selcomOrder): void
    {
        //
    }
}
