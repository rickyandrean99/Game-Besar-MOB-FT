<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('team', function($user) {
            return ($user->role == 'maharu') ? Response::allow() : Response::deny('No Access');
        });

        Gate::define('admin-quest', function($user) {
            return ($user->role == 'quest' || $user->role == 'admin') ? Response::allow() : Response::deny('No Access');
        });

        Gate::define('admin-shop', function($user) {
            return ($user->role == 'shop' || $user->role == 'admin') ? Response::allow() : Response::deny('No Access');
        });

        Gate::define('admin-rally', function($user) {
            return ($user->role == 'rally' || $user->role == 'admin') ? Response::allow() : Response::deny('No Access');
        });

        Gate::define('admin-itd', function($user) {
            return ($user->role == 'admin') ? Response::allow() : Response::deny('No Access');
        });
    }
}
