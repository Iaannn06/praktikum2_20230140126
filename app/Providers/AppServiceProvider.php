<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <-- Tambahan wajib
use App\Models\User;                 // <-- Tambahan wajib

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }


    public function boot(): void
    {
        // Bikin Gate bernama 'manage-product' khusus untuk admin
        Gate::define('manage-product', function (User $user) {
            return $user->role === 'admin';
        });
    }
}