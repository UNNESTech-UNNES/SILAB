<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // ...
        
        Gate::define('admin', function($user) {
            return $user->hasRole('admin');
        });

        Gate::define('peminjam', function($user) {
            return $user->hasRole('peminjam');
        });

        Gate::define('pemilik', function($user) {
            return $user->hasRole('pemilik');
        });
    }
} 