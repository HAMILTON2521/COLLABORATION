<?php

use App\Http\Controllers\Airtel;
use App\Http\Controllers\Api\SelcomController;
use App\Http\Middleware\JWTAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\callback;
use App\Traits\GeneralHelperTrait;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/uat/airtel', [Airtel::class, 'callback']);

Route::group(['prefix' => 'uat/airtel'], function () {
    Route::post('/callback', [Airtel::class, 'callback'])->middleware('callbackAck');
    Route::get('/callback', function () {
        return view('login.login_page');
    });
    Route::post('/validate', [Airtel::class, 'validate'])->middleware('jwt');
    Route::get('/validate', function () {
        return view('login.login_page');
    });
    Route::post('/process', [Airtel::class, 'process'])->middleware('jwt');
    Route::get('/process', function () {
        return view('login.login_page');
    });
    Route::post('/enquiry', [Airtel::class, 'enquiry'])->middleware('jwt');
    Route::get('/enquiry', function () {
        return view('login.login_page');
    });
    Route::post('/billFetch', [Airtel::class, 'fetchBill']);
    Route::get('/billFetch', function () {
        return view('login.login_page');
    });

    Route::post('/jwt', [Airtel::class, 'genNew']);
    Route::post('/validateJWT', [Airtel::class, 'validateJWT']);
});

Route::group(['prefix' => 'selcom'], function () {
    Route::post('/callback', [SelcomController::class, 'callback'])->name('selcom.callback');
    Route::post('/createOrder', [SelcomController::class, 'createOrder']);
});
