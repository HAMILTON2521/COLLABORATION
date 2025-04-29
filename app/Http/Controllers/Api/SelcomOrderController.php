<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SelcomPush;

class SelcomOrderController extends Controller
{
    public function cancelOrder()
    {
        flash()->error('Please check your phone and confirm PIN');
    }
    public function callback(Request $request)
    {
        info('Callback received', ['request transid' => $request['transid']]);


        if ($request && $request['resultcode']) {
            $push = SelcomPush::where('selcom_order_id', $request['order_id'])->first();

            if ($push) {
                $push->update([
                    'payment_status' => $request['payment_status'],
                    'is_paid' => $request['resultcode'] === '000',
                    'amount_paid' => $request['amount'] ? number_format((float) $request['amount'], 2, '.', '') : null,
                    'external_id' => $request['transid'],
                    'payment_result_code' => $request['resultcode'],
                    'payment_reference' => $request['reference'],
                    'channel' => $request['channel'],
                ]);
            }
        }
    }
}
