<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use App\Traits\SelcomHelperTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRquest;

class SelcomController extends Controller
{
    use SelcomHelperTrait;

    public function createOrder(OrderRquest $request)
    {
        try {
            $validatedData = $request->validated();

            $response = $this->createMinimumOrder(
                order_id: $validatedData['order_id'],
                amount: $validatedData['amount'],
                phone: $validatedData['phone'],
                email: $validatedData['email'],
                name: $validatedData['name']
            );

            return response()->json($response);
        } catch (HttpException $e) {
            if ($e->getStatusCode() == 401) {
                return response()->json([
                    'message' => 'Failed to create order',
                ], 400);
            }
        }
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
