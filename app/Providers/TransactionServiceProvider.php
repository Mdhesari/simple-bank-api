<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\TransactionFee;
use App\Repositories\Eloquent\TransactionFeeRepository;
use App\Repositories\Eloquent\TransactionRepository;
use App\Repositories\TransactionFeeRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TransactionRepositoryInterface::class, function (Application $app) {
            return new TransactionRepository(app(Transaction::class));
        });

        $this->app->bind(TransactionFeeRepositoryInterface::class, function (Application $app) {
            return new TransactionFeeRepository(app(TransactionFee::class));
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
