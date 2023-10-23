<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        Gate::define('is-admin', function (User $user) {
            return $user->role === "admin";
        });
        Gate::define('is-user', function (User $user) {
            return $user->role === "user";
        });
        Gate::define('is-verified', function (User $user) {
            return $user->email_verified_at!=null;
        });
    }
}
