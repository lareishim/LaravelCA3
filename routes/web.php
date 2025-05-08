<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AdminController;

// Public homepage
Route::view('/', 'welcome');

// Profile routes (for all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
});

// Public: fans can view players
Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');

// Authenticated users can like/unlike players
Route::middleware('auth')->group(function () {
    Route::post('/players/{player}/like', [PlayerController::class, 'like'])->name('players.like');
    Route::delete('/players/{player}/unlike', [PlayerController::class, 'unlike'])->name('players.unlike');
});

// Admin-only: manage players
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
    Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{player}/edit', [PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{player}', [PlayerController::class, 'destroy'])->name('players.destroy');

    // ✅ Admin user management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

// Google login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// Laravel Breeze auth
require __DIR__.'/auth.php';
