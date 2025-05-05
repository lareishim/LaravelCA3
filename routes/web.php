<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FanController;
use Illuminate\Support\Facades\Route;

// Public homepage
Route::get('/', function () {
    return view('welcome');
});

// ✅ Guest dashboard (for unauthenticated visitors)
Route::get('/dashboard', function () {
    return view('guest.dashboard');
})->name('guest.dashboard');


// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ FAN-only dashboard
Route::middleware(['auth', 'role:fan'])->group(function () {
    Route::get('/fan/dashboard', [FanController::class, 'dashboard'])->name('fan.dashboard');
});

require __DIR__.'/auth.php';
