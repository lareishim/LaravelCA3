<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PlayerController;

// Public homepage
Route::view('/', 'welcome');

// Profile routes (for all roles)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Single dashboard route for all roles
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

// Public/fan access to view players
Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');

// Admin-only access to manage players
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('players', PlayerController::class)->except(['index', 'show']);
});

// Google login (fans only)
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// Laravel Breeze Auth routes
require __DIR__.'/auth.php';
