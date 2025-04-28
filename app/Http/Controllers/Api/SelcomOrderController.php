<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelcomOrderController extends Controller
{
    public function cancelOrder()
    {
        flash()->error('Please check your phone and confirm PIN');
    }
    public function callback(Request $request)
    {
        info('Callback received', ['request' => json_encode($request->all())]);
    }
}
