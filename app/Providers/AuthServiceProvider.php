<?php

namespace Muserpol\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Muserpol\User;
use Muserpol\Policies\EconomicComplementPolicy;
use Muserpol\EconomicComplement;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         EconomicComplement::class => EconomicComplementPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        $gate->define('manage', function ($user) {
            foreach ($user->roles as $role) {
                if ($role->id==1) {
                    return true;
                }
            }
        });
    }
}
