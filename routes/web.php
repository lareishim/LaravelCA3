<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// 🌐 Public homepage
Route::view('/', 'welcome');

// 🔐 Authenticated users
Route::middleware('auth')->group(function () {
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    // 💬 Message System (Announcements)
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages.index');
    Route::get('/messages/{announcement}', [AdminController::class, 'showMessage'])->name('messages.show');

    // Player like/unlike
    Route::post('/players/{player}/like', [PlayerController::class, 'like'])->name('players.like');
    Route::delete('/players/{player}/unlike', [PlayerController::class, 'unlike'])->name('players.unlike');

    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/mine', [PostController::class, 'myPosts'])->name('posts.mine');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Post reporting
    Route::post('/posts/{post}/report', [AdminController::class, 'storeReport'])->name('posts.report');
});

// 👥 Public: view players
Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');

// 🔐 Admin-only routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Player management
    Route::get('/players/create', [PlayerController::class, 'create'])->name('players.create');
    Route::post('/players', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{player}/edit', [PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{player}', [PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{player}', [PlayerController::class, 'destroy'])->name('players.destroy');

    // User management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    // Post approval
    Route::get('/posts/pending', [AdminController::class, 'pendingPosts'])->name('posts.pending');
    Route::patch('/posts/{post}/approve', [AdminController::class, 'approvePost'])->name('posts.approve');

    // Reports
    Route::get('/reports', [AdminController::class, 'showReports'])->name('reports');

    // Activity Logs
    Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
    Route::delete('/logs/clear', [AdminController::class, 'clearLogs'])->name('logs.clear');

    // Optional tools
    Route::get('/content/pending', [AdminController::class, 'pendingContent'])->name('content.pending');

    // Announcements (admin creates them)
    Route::get('/announcements/create', [AdminController::class, 'createAnnouncement'])->name('announcements.create');
    Route::post('/announcements', [AdminController::class, 'storeAnnouncement'])->name('announcements.store');
});

// 🔐 Google login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// 🛡️ Breeze Auth scaffolding (login, register, etc.)
require __DIR__.'/auth.php';
