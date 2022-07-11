<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Product::class => ProductPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
   
        Gate::define('isAdmin', function ($user) {
            return $user->role == 'admin';
        });
        
        Gate::define('isManager', function ($user) {
            return $user->role == 'manager';
        });
      
        Gate::define('isUser', function ($user) {
            return $user->role == 'user';
        });
    }
}
