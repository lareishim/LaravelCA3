<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AdminController;

// Public homepage
Route::view('/', 'welcome');

// Authenticated users: profile and dashboard
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    // Like/unlike players
    Route::post('/players/{player}/like', [PlayerController::class, 'like'])->name('players.like');
    Route::delete('/players/{player}/unlike', [PlayerController::class, 'unlike'])->name('players.unlike');
});

// Public: view players
Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');

// Admin-only: manage players + users + tools
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Players
    Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
    Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{player}/edit', [PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{player}', [PlayerController::class, 'destroy'])->name('players.destroy');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    // Optional future tools
    Route::get('/content/pending', [AdminController::class, 'pendingContent'])->name('content.pending');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
    Route::get('/announcements/create', [AdminController::class, 'createAnnouncement'])->name('announcements.create');
});

// Google login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// Breeze auth
require __DIR__.'/auth.php';
