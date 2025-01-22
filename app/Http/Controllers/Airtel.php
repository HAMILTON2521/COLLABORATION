<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Airtel extends Controller
{
    public function callback(Request $request)
    {
        Log::info(json_encode($request->all()));

        return response()->json([
            'status' => 'Success',
            'message' => 'Callback received successfully'
        ]);
    }
}
