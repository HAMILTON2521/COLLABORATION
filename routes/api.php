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
    Route::get('/callback', function () {
        return view('login.login_page');
    });
    Route::post('/validate', [Airtel::class, 'validate']);
    Route::get('/validate', function () {
        return view('login.login_page');
    });
    Route::post('/process', [Airtel::class, 'process']);
    Route::get('/process', function () {
        return view('login.login_page');
    });
    Route::post('/enquiry', [Airtel::class, 'enquiry']);
    Route::get('/enquiry', function () {
        return view('login.login_page');
    });
    Route::post('/billFetch', [Airtel::class, 'fetchBill']);
    Route::get('/billFetch', function () {
        return view('login.login_page');
    });
});
