<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\CreditCard;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\CreditCardRepositoryInterface;
use App\Repositories\Eloquent\AccountRepository;
use App\Repositories\Eloquent\CreditCardRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AccountRepositoryInterface::class, function (Application $app) {
            return new AccountRepository($app->make(Account::class));
        });

        $this->app->bind(CreditCardRepositoryInterface::class, function (Application $app) {
            return new CreditCardRepository($app->make(CreditCard::class));
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
