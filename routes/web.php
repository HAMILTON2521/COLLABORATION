<?php

use App\Livewire\Files\Files;
use App\Livewire\Login\Login;
use App\Livewire\Users\Users;
use App\Livewire\Web\AboutUs;
use App\Livewire\Login\Signup;
use App\Livewire\Web\HomePage;
use App\Livewire\Portal\BuyGas;
use App\Livewire\Web\ContactUs;
use App\Livewire\Data\DataQuery;
use App\Livewire\Files\EditFile;
use App\Livewire\Portal\Account;
use App\Livewire\User\MyProfile;
use App\Livewire\Users\EditUser;
use App\Livewire\Web\GetStarted;
use App\Livewire\Customer\Region;
use App\Livewire\Portal\Payments;
use App\Livewire\User\MyInvoices;
use App\Livewire\Settlement\Daily;
use App\Livewire\Users\CreateUser;
use App\Livewire\Files\FileDetails;
use App\Livewire\Portal\BuyGasForm;
use App\Livewire\Portal\NewPayment;
use App\Livewire\Portal\SelcomForm;
use App\Livewire\Settings\Settings;
use App\Livewire\Topup\RemoteTopup;
use App\Livewire\Users\UserDetails;
use App\Livewire\Customer\Customers;
use App\Livewire\Files\AddMeterFile;
use App\Livewire\Settlement\Monthly;
use App\Livewire\Users\UserAccounts;
use App\Livewire\Data\ReadDeviceData;
use App\Livewire\Equipment\Equipment;
use App\Livewire\Users\AssignAccount;
use Illuminate\Support\Facades\Route;
use App\Livewire\Household\Households;
use App\Livewire\Login\ForgotPassword;
use App\Livewire\Portal\UserDashboard;
use App\Livewire\Topup\RechargeDevice;
use App\Livewire\User\AccountSettings;
use App\Livewire\Customer\EditCustomer;
use App\Livewire\Payments\YdayPayments;
use App\Livewire\Equipment\ValveControl;
use App\Livewire\Equipment\ValveDetails;
use App\Livewire\Payments\TodayPayments;
use App\Livewire\Customer\CreateCustomer;
use App\Livewire\Dashboard\AdminHomePage;
use App\Livewire\Equipment\StatusCommand;
use App\Livewire\Household\EditHousehold;
use App\Livewire\Payments\PaymentDetails;
use App\Livewire\Customer\CustomerDetails;
use App\Livewire\Equipment\BatteryCommand;
use App\Http\Controllers\ProfileController;
use App\Livewire\Equipment\NewValveControl;
use App\Livewire\Household\CreateHousehold;
use App\Livewire\Equipment\ValveControlRecords;
use App\Livewire\Payments\RechargeOrderDetails;
use App\Http\Controllers\Api\SelcomController;
use App\Livewire\Payments\Payments as PaymentsPayments;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Livewire\Settings\Sms\SmsSettings;

Route::get('/login', Login::class)->name('login');
Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/signup', Signup::class)->name('signup');
Route::get('/get-started/{token}', GetStarted::class)->name('get-started');

/**
 *
 * Routes below require an authenticated user
 *
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', AdminHomePage::class)->name('dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::prefix('portal')->group(function () {
        Route::get('/', UserDashboard::class)->name('portal');
        Route::get('/payments', Payments::class)->name('portal.payments');
        Route::get('/payments/new', NewPayment::class)->name('portal.payments.new');
        Route::get('/account', Account::class)->name('portal.account');
        Route::get('/buy-gas/{customer}', BuyGas::class)->name('portal.account.buy');
        Route::get('/buy-gas/airtel/{customer}', BuyGasForm::class)->name('portal.account.buy.airtel');
        Route::get('/buy-gas/selcom/{customer}', SelcomForm::class)->name('portal.account.buy.selcom');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/my-profile', MyProfile::class)->name('profile.my.profile');
        Route::get('/my-invoices', MyInvoices::class)->name('profile.my.invoices');
        Route::get('/account-settings', AccountSettings::class)->name('profile.account.settings');
    });

    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', Customers::class)->name('customers');
        Route::get('/create', CreateCustomer::class)->name('customers.create');
        Route::get('/{customer}', CustomerDetails::class)->name('customers.details');
        Route::get('/{customer}/edit', EditCustomer::class)->name('customers.edit');
        Route::get('/region/{region}', Region::class)->name('customers.region');
    });
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/sms', SmsSettings::class)->name('settings.sms');
        Route::get('/general', Settings::class)->name('settings.general');
    });
    Route::group(['prefix' => 'data'], function () {
        Route::get('/query', DataQuery::class)->name('more.data.query');
        Route::get('/device-data', ReadDeviceData::class)->name('more.data.device.data');
    });
    Route::group(['prefix' => 'equipment'], function () {
        Route::get('/', Equipment::class)->name('more.equipment');
        Route::get('/valve', ValveControl::class)->name('more.equipment.valve');
        Route::get('/valve/{valve}', ValveDetails::class)->name('more.equipment.valve.details');
        Route::get('/new-valve-control', NewValveControl::class)->name('more.equipment.valve.new');
        Route::get('/battery-command', BatteryCommand::class)->name('more.equipment.battery.command');
        Route::get('/status-command', StatusCommand::class)->name('more.equipment.status.command');
        Route::get('/valve-control/{customer}', ValveControlRecords::class)->name('more.equipment.valve.control');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', Users::class)->name('more.users');
        Route::get('/new', CreateUser::class)->name('more.users.create');
        Route::get('/{user}/edit', EditUser::class)->name('more.users.edit');
        Route::get('/{user}', UserDetails::class)->name('more.users.show');
        Route::get('/{user}', UserDetails::class)->name('more.users.show');
        Route::get('/account/assign/{user}', AssignAccount::class)->name('more.users.assign');
        Route::get('/accounts/{user}', UserAccounts::class)->name('more.users.accounts');
    });
    Route::group(['prefix' => 'topup'], function () {
        Route::get('/remote', RemoteTopup::class)->name('topup.remote.topup');
        Route::get('/order-details', RechargeOrderDetails::class)->name('topup.order.details');
        Route::get('/payments', PaymentsPayments::class)->name('topup.airtel.payments');
        Route::get('/today', TodayPayments::class)->name('topup.airtel.payments.today');
        Route::get('/yday', YdayPayments::class)->name('topup.airtel.payments.yday');
        Route::get('/{payment}', PaymentDetails::class)->name('topup.payment.details');
        Route::get('/recharge-device/{customer}', RechargeDevice::class)->name('topup.payment.recharge');
    });
    Route::group(['prefix' => 'households'], function () {
        Route::get('/', Households::class)->name('households');
        Route::get('/create', CreateHousehold::class)->name('households.create');
        Route::get('/{household}/edit', EditHousehold::class)->name('households.edit');
    });
    Route::group(['prefix' => 'settlement'], function () {
        Route::get('/daily', Daily::class)->name('settlement.daily');
        Route::get('/monthly', Monthly::class)->name('settlement.monthly');
    });
    Route::group(['prefix' => 'files'], function () {
        Route::get('/add-meter-file', AddMeterFile::class)->name('files.add.meter.file');
        Route::get('/edit-meter-file', EditFile::class)->name('files.edit.meter.file');
        Route::get('/archive-list', Files::class)->name('files.archive.list')->lazy();
        Route::get('/meter-file/{imei}', FileDetails::class)->name('files.meter.file.details')->lazy();
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
Route::get('/contact-us', ContactUs::class)->name('web.contact-us');
Route::get('/c2b', [SelcomController::class, 'cancelOrder']);

/**
 * Preview email templates
 */
Route::get('/mail', function () {
    $data = App\Models\User::where('email', 'bmahuvi@gmail.com')->first();

    return new App\Mail\NotifyCreatedUser($data);
});


require __DIR__ . '/auth.php';
