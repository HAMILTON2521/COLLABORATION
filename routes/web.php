<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login.login_page')->name('login');
Route::get('/signup', function () {
    return view('login.signup_page');
})->name('login.signup');
Route::get('/forgot-password', function () {
    return view('login.forgot_password');
})->name('login.forgot_password');

Route::get('/dashboard', function () {
    return view('dashboard.home');
})->name('dashboard.home');
Route::get('my-profile', function () {
    return view('dashboard.profile.my_profile');
})->name('dashboard.profile');
Route::get('account-settings', function () {
    return view('dashboard.profile.account_settings');
})->name('dashboard.account.settings');
Route::get('my-invoices', function () {
    return view('dashboard.profile.my_invoices');
})->name('dashboard.account.invoices');
Route::group(['prefix' => 'customers'], function () {
    Route::get('/', function () {
        return view('dashboard.customers.all');
    })->name('dashboard.customers');
    Route::get('/create', function () {
        return view('dashboard.customers.create');
    })->name('dashboard.customers.create');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// require __DIR__ . '/auth.php';
