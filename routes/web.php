<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitGroupController;

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
Route::middleware('auth', 'verified')->group(function () {
    Route::resource('/general-manager/users', UserController::class);

    // Room
    Route::resource('/room/unit-groups', UnitGroupController::class);
});



// Administration & Finance Manager

// Room Division Manager

// Front Desk

// Housekeeper

// Sales & Marketing Manager




// Route::get('generalmanager', function () {
//     return '<h1>hello general manager</h1>';
// })->middleware(['auth', 'verified', 'role:general manager']);

// Route::get('frontdesk', function () {
//     return view('frontdesk');
// })->middleware(['auth', 'verified', 'role:front desk|general manager']);

require __DIR__.'/auth.php';
