<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatePlanController;
use App\Http\Controllers\UnitGroupController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\HousekeepingController;
use App\Http\Controllers\InvoiceFoliosController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Email
Route::get('/Account/ConfirmEmail/{remember_token}/{email}', [UserController::class, 'show'])->name('verif-akun');
Route::post('updatePass/{token}/{email}', [UserController::class, 'updatePass'])->name('set-pass');

// General Manager
Route::middleware('auth', 'verified', 'role:general manager')->group(function () {
    Route::resource('/general-manager/users', UserController::class);

    // Room
    Route::resource('/room/unit-groups', UnitGroupController::class);
    Route::resource('/room/units', UnitController::class);
    Route::get('/rate-plans/{unitGroupId}', [UnitController::class, 'getRatePlansByRoomType']);
});

// Administration & Finance Manager
Route::middleware('auth', 'verified')->group( function() {
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
    
    Route::get('/finance/invoice', [InvoiceFoliosController::class, 'indexInvoice']);
    Route::get('/finance/folios', [InvoiceFoliosController::class, 'indexFolios']);

    Route::get('/finance/folios/report', [InvoiceFoliosController::class, 'generatePDFReport']);
    Route::get('/finance/invoice/pdf/{id}', [InvoiceFoliosController::class, 'generatePdfinvoice']);
    Route::get('/finance/folios/pdf/{id}', [InvoiceFoliosController::class, 'generatePdffolios']);
});

// Room Division Manager


// Front Desk
Route::middleware('auth', 'verified', 'role:front desk|general manager')->group( function() {
    // Guest
    Route::resource('/guests', GuestController::class);

    // Reservation
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::post('/reservations/restore-all', [ReservationController::class, 'restoreAll'])->name('reservations.restoreAll');

    Route::get('/reservations/{id}/edit/{edit?}', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{id}/update1', [ReservationController::class, 'update1'])->name('reservations.update1');
    Route::put('/reservations/{id}/update2', [ReservationController::class, 'update2'])->name('reservations.update2');
    Route::put('/reservations/{id}/update3', [ReservationController::class, 'update3'])->name('reservations.update3');

    Route::get('/reservations/create/{step?}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/step1', [ReservationController::class, 'postStep1'])->name('reservations.postStep1');
    Route::post('/reservations/step2', [ReservationController::class, 'postStep2'])->name('reservations.postStep2');
    Route::post('/reservations/step3', [ReservationController::class, 'postStep3'])->name('reservations.postStep3');
    Route::post('/reservations/step4', [ReservationController::class, 'postStep4'])->name('reservations.postStep4');

    // Booking
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookers.update');

    Route::get('/bookings/create/{step?}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/step1/{bookerId}', [BookingController::class, 'postStep1'])->name('bookings.postStep1');
    Route::post('/bookings/step2/{bookerId}', [BookingController::class, 'postStep2'])->name('bookings.postStep2');
    Route::post('/bookings/step3/{bookerId}', [BookingController::class, 'postStep3'])->name('bookings.postStep3');
});

// Housekeeper
Route::middleware('auth', 'verified')->group( function() {
    Route::get('/housekeeping', [HousekeepingController::class, 'index'])->name('housekeeping.index');
    Route::post('/housekeeping/update-status/{id}', [HousekeepingController::class, 'updateStatus'])->name('housekeeping.updateStatus');
    Route::get('/housekeeping/units', [HousekeepingController::class, 'getUnitData'])->name('housekeeping.getUnitData');
    Route::get('/housekeeping/unit-groups', [HousekeepingController::class, 'getUnitGroup'])->name('housekeeping.getUnitGroup');
    Route::get('/housekeeping/search', [HousekeepingController::class, 'searchData'])->name('housekeeping.searchData');
});

// Sales & Marketing Manager
Route::middleware('auth', 'verified')->group( function() {
    Route::resource('/sales/rate-plans', RatePlanController::class);
});




// Route::get('generalmanager', function () {
//     return '<h1>hello general manager</h1>';
// })->middleware(['auth', 'verified', 'role:general manager']);

// Route::get('frontdesk', function () {
//     return view('frontdesk');
// })->middleware(['auth', 'verified', 'role:front desk|general manager']);

require __DIR__.'/auth.php';
