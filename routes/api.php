<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Airtel;
use App\Traits\GeneralHelperTrait;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SelcomController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'prod/airtel'], function () {
    Route::post('/callback', [Airtel::class, 'callback'])->middleware('callbackAck');
    Route::post('/validate', [Airtel::class, 'validate'])->middleware('jwt');
    Route::post('/process', [Airtel::class, 'process'])->middleware('jwt');
    Route::post('/enquiry', [Airtel::class, 'enquiry'])->middleware('jwt');
    Route::post('/billFetch', [Airtel::class, 'fetchBill']);

    Route::post('/jwt', [Airtel::class, 'genNew']);
    Route::post('/validateJWT', [Airtel::class, 'validateJWT']);
});

Route::middleware('selcomMerchantToken')->group(function () {
    Route::prefix('selcom')->group(function () {
        Route::post('/callback', [SelcomController::class, 'callback'])->name('selcom.callback');
        Route::post('/merchant/validation', [SelcomController::class, 'merchantValidation']);
        Route::post('/merchant/notification', [SelcomController::class, 'merchantPayment'])->name('selcom.merchant.callback');
    });
});
