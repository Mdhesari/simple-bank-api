<?php

namespace App\Providers;

use App\Models\Account;
use App\Repositories\Eloquent\AccountRepository;
use App\Services\AccountService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AccountService::class, function (Application $app) {
            return new AccountService(
                new AccountRepository($app->make(Account::class))
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
