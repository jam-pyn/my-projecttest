<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Roles' => 'App\Policies\RolesPolicy',

        //
    ];

    /**
     * Register any authentication / authorization services.
     */


    public function boot(): void
    {
        //
        $this->registerPolicies();
        Gate::before(function ($user, $ability) {
            if (!$user->relationLoaded('role')) {
                $user->load('role');
            }

            if ($user->checkRole('SADM')) {
                return true;
            }
        });


        Gate::define('SADM', function ($user) {
            return $user->checkRole('SADM');
        });


        Gate::define('MOD', function ($user) {
            return $user->checkRole('MOD');
            //return false;
        });
        Gate::define('EDT', function ($user) {
            return $user->checkRole('EDT');
            //return false;
        });
        Gate::define('VWR', function ($user) {
            return $user->checkRole('VWR');
            //return false;
        });
    }
}
