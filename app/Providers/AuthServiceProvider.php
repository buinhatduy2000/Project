<?php

namespace App\Providers;

use App\Models\Account;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('create-cate', function (Account $account) {
            return $account->is_QAM();
        });
        Gate::define('edit-cate', function (Account $account) {
            return in_array($account->role, [Account::ACCOUNT_QAM, Account::ACCOUNT_QAC, Account::ACCOUNT_ADMIN]);
        });
        Gate::define('delete-cate', function (Account $account) {
            return in_array($account->role, [Account::ACCOUNT_QAM, Account::ACCOUNT_QAC, Account::ACCOUNT_ADMIN]);
        });
        Gate::define('list-user', function (Account $account) {
            return $account->is_admin();
        });
        Gate::define('create-user', function (Account $account) {
            return $account->is_admin();
        });
        Gate::define('edit-user', function (Account $account) {
            return $account->is_admin();
        });
        Gate::define('delete-user', function (Account $account) {
            return $account->is_admin();
        });
    }
}
