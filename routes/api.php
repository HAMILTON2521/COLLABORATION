<?php

use App\Http\Controllers\Airtel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\callback;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/uat/airtel', [Airtel::class, 'callback']);

Route::group(['prefix' => 'uat/airtel'], function () {
    Route::post('/callback', [Airtel::class, 'callback']);
    Route::post('/validate', [Airtel::class, 'validate']);
    Route::post('/process', [Airtel::class, 'process']);
    Route::post('/enquiry', [Airtel::class, 'enquiry']);
    Route::post('/billFetch', [Airtel::class, 'fetchBill']);
});
