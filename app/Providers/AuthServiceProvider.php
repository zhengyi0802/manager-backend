<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    public static $permissions = [
       'manager'           => [ UserRole::Manager ],
       'accounter'         => [ UserRole::Accounter ],
       'reseller'          => [ UserRole::Reseller ],
       'distrobuter'       => [ UserRole::Distrobuter ],
       'member'            => [ UserRole::Member],
       'reseller-limit'    => [ UserRole::Reseller ],
       'distrobuter-limit' => [ UserRole::Distrobuter ],
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Roles based authorization
        Gate::before(
            function ($user, $ability) {
                if ($user->role === UserRole::Administrator) {
                    return true;
                }
            }
        );

        foreach (self::$permissions as $action => $roles) {
            Gate::define(
                $action,
                function ($user) use($action, $roles) {
                    if (in_array($user->role, $roles)) {
                        if ($action == 'reseller-limit' || $action == 'distrobuter-limit') {
                            if ($user->role == UserRole::Reseller || $user->role == UserRole::Distrobuter) {
                                return ($user->member->share_status);
                            }
                        }
                        return true;
                    }
                }
            );
        }
        //
    }
}
