<?php

namespace App\Providers;

use App\Rules\IrCreditCard;
use App\Rules\IrMobile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('ir_mobile', IrMobile::class);
        Validator::extend('ir_credit_card', IrCreditCard::class);
    }
}
