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
Route::group(['prefix' => 'profile'], function () {
    Route::get('/my-profile', function () {
        return view('dashboard.profile.my_profile');
    })->name('profile.my.profile');
    Route::get('/my-invoices', function () {
        return view('dashboard.profile.my_invoices');
    })->name('profile.my.invoices');
    Route::get('/account-settings', function () {
        return view('dashboard.profile.account_settings');
    })->name('profile.account.settings');
});
Route::get('my-invoices', function () {
    return view('dashboard.profile.my_invoices');
})->name('dashboard.account.invoices');
Route::group(['prefix' => 'customers'], function () {
    Route::get('/', function () {
        return view('dashboard.customers.all');
    })->name('customers');
    Route::get('/create', function () {
        return view('dashboard.customers.create');
    })->name('customers.create');
});
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', function () {
        return view('dashboard.settings.settings_home');
    })->name('settings');
});
Route::group(['prefix' => 'data'], function () {
    Route::get('/query', function () {
        return view('dashboard.data.data_query');
    })->name('more.data.query');
});
Route::group(['prefix' => 'equipment'], function () {
    Route::get('/equipment', function () {
        return view('dashboard.equipment.equipment');
    })->name('more.equipment');
});
Route::group(['prefix' => 'topup'], function () {
    Route::get('/remote', function () {
        return view('dashboard.topup.remote_topup');
    })->name('topup.remote.topup');
    Route::get('/order-details', function () {
        return view('dashboard.topup.order_details');
    })->name('topup.order.details');
});
Route::group(['prefix' => 'accounts'], function () {
    Route::get('/', function () {
        return view('dashboard.account.all');
    })->name('accounts');
    Route::get('/create', function () {
        return view('dashboard.account.add');
    })->name('accounts.create');
});
Route::group(['prefix' => 'settlement'], function () {
    Route::get('/daily', function () {
        return view('dashboard.settlement.daily');
    })->name('settlement.daily');
    Route::get('/monthly', function () {
        return view('dashboard.settlement.monthly');
    })->name('settlement.monthly');
});
Route::group(['prefix' => 'files'], function () {
    Route::get('/add-meter-file', function () {
        return view('dashboard.files.add_meter_file');
    })->name('files.add.meter.file');
    Route::get('/edit-meter-file', function () {
        return view('dashboard.files.edit_meter_file');
    })->name('files.edit.meter.file');
    Route::get('/get-archive-list', function () {
        return view('dashboard.files.get_archive_list');
    })->name('files.archive.list');
    Route::get('/meter-file', function () {
        return view('dashboard.files.meter_file_details');
    })->name('files.meter.file.details');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// require __DIR__ . '/auth.php';
