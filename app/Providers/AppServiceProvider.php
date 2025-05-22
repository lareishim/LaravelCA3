<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $pendingCount = 0;
            $user = Auth::user();

            if ($user && $user->hasRole('admin')) {
                $pendingCount = Post::where('approved', false)->count();
            }

            $view->with('pendingCount', $pendingCount);
        });
    }
}
