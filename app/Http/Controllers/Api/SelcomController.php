<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\SelcomHelperTrait;
use App\Http\Controllers\Controller;

class SelcomController extends Controller
{
    use SelcomHelperTrait;

    public function createOrder(Request $request)
    {
        info('Request to create minimum order', ['request' => $request->all()]);

        $data = [
            'orderId' => Str::uuid(),
            'email' => 'bmahuvi@gmail.com',
            'phone' => '255762691069',
            'amount' => 500,
            'name' => 'Bryson Mahuvi'
        ];

        $response = $this->createMinimumOrder(
            order_id: $data['orderId'],
            amount: $data['amount'],
            phone: $data['phone'],
            email: $data['email'],
            name: $data['name']
        );

        return response()->json($response);
    }
    public function cancelOrder(Request $request)
    {
        info('Request to cancel order', ['request' => $request->all()]);
    }
    public function callback(Request $request)
    {
        info('Callback received', ['request' => $request->all()]);
    }
    public function queryOrderStatus(Request $request)
    {
        info('Request to query order status', ['request' => $request->all()]);
    }
}
