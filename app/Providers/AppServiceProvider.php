<?php

namespace App\Providers;



use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;  // Import facade Gate untuk mendefinisikan kebijakan akses pada aplikasi

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
        Gate::define('manage-category', function ($user) { // Mendefinisikan gate 'manage-category' yang memeriksa apakah pengguna memiliki peran 'admin' untuk mengelola kategori
            return $user->role === 'admin'; // Mengembalikan true jika peran pengguna adalah 'admin', sehingga pengguna tersebut dapat
        });

        Gate::define('manage-product', function ($user) { // Mendefinisikan gate 'manage-product' yang memeriksa apakah pengguna memiliki peran 'admin' untuk mengelola produk
            return $user->role === 'admin'; // Mengembalikan true jika peran pengguna adalah 'admin', sehingga pengguna tersebut dapat mengelola produk
        });
    }

}
