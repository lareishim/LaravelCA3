<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;  // Added import for CommentController

// Public homepage
Route::view('/', 'welcome');

// Authenticated users: profile, dashboard, posts, comments
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    // Like/unlike players
    Route::post('/players/{player}/like', [PlayerController::class, 'like'])->name('players.like');
    Route::delete('/players/{player}/unlike', [PlayerController::class, 'unlike'])->name('players.unlike');

    // Posts (fan/editor/admin access)
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/mine', [PostController::class, 'myPosts'])->name('posts.mine');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Comments - only logged-in users can post comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
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

    // Admin post approval
    Route::get('/posts/pending', [AdminController::class, 'pendingPosts'])->name('posts.pending');
    Route::patch('/posts/{post}/approve', [AdminController::class, 'approvePost'])->name('posts.approve');

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

// Reports
Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post}/report', [PostReportController::class, 'store'])->name('posts.report');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin/reports', [PostReportController::class, 'index'])->name('admin.reports');
});
