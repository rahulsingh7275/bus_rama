<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusStopageController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusBookingController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusStationController;
use App\Http\Controllers\BusPickupDropPointController;
use App\Http\Controllers\Payment\EasebuzzController;
use App\Http\Controllers\BusOffDayController;
use App\Http\Controllers\Payment\CashfreeController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\PaymentSettingsController;
use App\Http\Controllers\WebsiteSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cleared!";

});

Route::get('/', [HomeController::class, 'welcome']);
Route::get('contact-us', [HomeController::class, 'contactUs']);
Route::get('about-us', [HomeController::class, 'aboutUs']);
Route::get('gallery-page', [HomeController::class, 'galleryPage']);
Route::get('cancellation-refund', [HomeController::class, 'cancellationRefund']);
Route::get('security', [HomeController::class, 'security']);
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy']);
Route::get('terms-and-conditions', [HomeController::class, 'termsServices']);
Route::get('shipping-and-delivery-policy', [HomeController::class, 'shippingPolishing']);
Route::get('faqs', [HomeController::class, 'faqs']);
Route::get('search-buses', [BusBookingController::class, 'search_buses']);
Route::get('admin', [BusBookingController::class, 'admin']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');


    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin-dashboard');
        Route::resource('bus_stations', BusStationController::class);
        Route::resource('bus_pickup_drop_points', BusPickupDropPointController::class);
        Route::resource('bus_stopages', BusStopageController::class);
        Route::resource('buses', BusController::class);
        Route::resource('bus-off-days', BusOffDayController::class);
        Route::resource('conductors', ConductorController::class);
        Route::resource('tickets', TicketController::class);
        Route::post('cash-payment/{id}', [TicketController::class, 'cashPayment'])->name('cash-payment'); // Ensure unique name
        Route::get('website_setting', [WebsiteSettingController::class, 'edit']);
        Route::post('website_setting', [WebsiteSettingController::class, 'update']);
        Route::resource('payment-settings', PaymentSettingsController::class);
    });

    Route::post('tickets', [TicketController::class, 'store']);
    Route::get('ticket-details/{id}', [TicketController::class, 'ticketDetails'])->name('ticket-details'); // Correct route name
    Route::get('payment-process/{id}', [TicketController::class, 'paymentProcess'])->name('payment-process'); // Ensure unique name
    Route::get('payment-success/{id}', [TicketController::class, 'paymentProcess'])->name('payment-success'); // Ensure unique name

    // Route::get('easebuzz/initiate_payment_show', [EasebuzzController::class, 'initiate_payment_show']);
    Route::post('easebuzz/initiate_payment_ebz', [EasebuzzController::class, 'initiate_payment_ebz']);
    Route::post('easebuzz/ebz_savePaymentResponse', [EasebuzzController::class, 'ebz_savePaymentResponse'])->name('ebz_savePaymentResponse');
    Route::get('easebuzz/ebz_response/{id}', [EasebuzzController::class, 'ebz_response']);
    Route::get('/easebuzz/get-payment-status', [EasebuzzController::class, 'getPaymentStatus']);
    Route::post('/payment/refund/{id}', [EasebuzzController::class, 'refundPayment']);
    Route::get('ticket/qrcode/{id}', [TicketController::class, 'generateQRCode'])->name('ticket.qrcode');

    // razorpay payment gateway
    // Route::get('/razorpay', [RazorpayController::class, 'index']);
    // Route::post('/razorpay', [RazorpayController::class, 'initiatePayment']);
    Route::post('/razorpay-callback/{id}', [RazorpayController::class, 'paymentCallback']);
    Route::post('cashfree/payments/store/{id}', [CashfreeController::class, 'store'])->name('cashfree.store');
    Route::any('cashfree/payments/success/{id}', [CashfreeController::class, 'success'])->name('cashfree.success');

});



// Route::get('cashfree/payments/create', [CashfreePaymentController::class, 'create'])->name('callback');
// Route::post('cashfree/payments/store', [CashfreePaymentController::class, 'store'])->name('store');
// Route::any('cashfree/payments/success', [CashfreePaymentController::class, 'success'])->name('success');
