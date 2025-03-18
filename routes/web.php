<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Livewire\Customer\CreateCustomer;
use App\Livewire\Customer\CustomerDetails;
use App\Livewire\Customer\Customers;
use App\Livewire\Customer\EditCustomer;
use App\Livewire\Dashboard\AdminHomePage;
use App\Livewire\Household\CreateHousehold;
use App\Livewire\Household\EditHousehold;
use App\Livewire\Household\Households;
use App\Livewire\Login\ForgotPassword;
use App\Livewire\Login\Login;
use App\Livewire\Login\Signup;
use App\Livewire\Topup\AirtelPayments;
use App\Livewire\User\AccountSettings;
use App\Livewire\User\MyInvoices;
use App\Livewire\User\MyProfile;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\UserDetails;
use App\Livewire\Users\Users;
use App\Livewire\Web\AboutUs;
use App\Livewire\Web\Blog;
use App\Livewire\Web\ContactUs;
use App\Livewire\Web\HomePage;
use App\Livewire\Web\Pricing;
use Illuminate\Support\Facades\Route;

Route::get('/login', Login::class)->name('login');
Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/signup', Signup::class)->name('signup');

/**
 *
 * Routes below require an authenticated user
 *
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', AdminHomePage::class)->name('dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/my-profile', MyProfile::class)->name('profile.my.profile');
        Route::get('/my-invoices', MyInvoices::class)->name('profile.my.invoices');
        Route::get('/account-settings', AccountSettings::class)->name('profile.account.settings');
    });
    Route::get('my-invoices', function () {
        return view('dashboard.profile.my_invoices');
    })->name('dashboard.account.invoices');

    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', Customers::class)->name('customers');
        Route::get('/create', CreateCustomer::class)->name('customers.create');
        Route::get('/{customer}', CustomerDetails::class)->name('customers.details');
        Route::get('/{customer}/edit', EditCustomer::class)->name('customers.edit');
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
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', Users::class)->name('more.users');
        Route::get('/new', CreateUser::class)->name('more.users.create');
        Route::get('/{user}/edit', EditUser::class)->name('more.users.edit');
        Route::get('/{user}', UserDetails::class)->name('more.users.show');
    });
    Route::group(['prefix' => 'topup'], function () {
        Route::get('/remote', function () {
            return view('dashboard.topup.remote_topup');
        })->name('topup.remote.topup');
        Route::get('/order-details', function () {
            return view('dashboard.topup.order_details');
        })->name('topup.order.details');
        Route::get('/airtel', AirtelPayments::class)->name('topup.airtel.payments');
    });
    Route::group(['prefix' => 'households'], function () {
        Route::get('/', Households::class)->name('households');
        Route::get('/create', CreateHousehold::class)->name('households.create');
        Route::get('/{household}/edit', EditHousehold::class)->name('households.edit');
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Frontend routes
 */

Route::get('/', HomePage::class)->name('web.home-page');
Route::get('/about', AboutUs::class)->name('web.about-us');
Route::get('/blog', Blog::class)->name('web.blog');
Route::get('/contact-us', ContactUs::class)->name('web.contact-us');
Route::get('/pricing', Pricing::class)->name('web.pricing');

/**
 * Preview email templates
 */
Route::get('/mail', function () {
    $contactUs = App\Models\ContactUs::first();

    return new App\Mail\ContactUsCreated($contactUs);
});


require __DIR__ . '/auth.php';
