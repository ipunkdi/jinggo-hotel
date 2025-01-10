<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatePlanController;
use App\Http\Controllers\UnitGroupController;
use App\Http\Controllers\HousekeepingController;

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


// Room Division Manager

// Front Desk

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
