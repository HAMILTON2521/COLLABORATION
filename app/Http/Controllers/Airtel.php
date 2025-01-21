<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Airtel extends Controller
{
    public function callback()
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Callback received successfully'
        ]);
    }
}
