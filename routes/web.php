<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('generalmanager', function () {
    return '<h1>hello general manager</h1>';
})->middleware(['auth', 'verified', 'role:general manager']);

Route::get('frontdesk', function () {
    return '<h1>hello front desk</h1>';
})->middleware(['auth', 'verified', 'role:front desk|general manager']);

require __DIR__.'/auth.php';
