<?php

namespace App\Providers;

use App\Models\Account;
use App\Repositories\Postgres\AccountRepository;
use App\Services\AccountService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AccountService::class, function (Application $app) {
            return new AccountService(
                new AccountRepository($app->make(Account::class))
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
