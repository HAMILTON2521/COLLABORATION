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
        info('Callback received', ['request' => json_encode($request->all())]);
        $callback = json_encode($request->all());

        if ($callback && $callback['resultcode']) {
            $push = SelcomPush::where('selcom_order_id', $callback['order_id'])->first();

            if ($push) {
                $push->update([
                    'payment_status' => $callback['payment_status'],
                    'is_paid' => $callback['resultcode'] === '000',
                    'amount_paid' => $callback['amount'] ? number_format((float) $callback['amount'], 2, '.', '') : null,
                    'external_id' => $callback['transid'],
                    'payment_result_code' => $callback['resultcode'],
                    'reference' => $callback['reference'],
                    'channel' => $callback['channel'],
                ]);
            }
        }
    }
}
