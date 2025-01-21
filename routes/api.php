<?php

use App\Http\Controllers\Airtel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/uat/airtel', [Airtel::class, 'callback']);
