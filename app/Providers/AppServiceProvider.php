<?php

namespace App\Providers;

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
        Validator::extend('ir_mobile', function ($attribute, $value, $parameters) {
            $paramsPatternMap = [
                'zero_code'    => '/^(00989){1}[0-9]{9}+$/',
                'plus'         => '/^(\+989){1}[0-9]{9}+$/',
                'code'         => '/^(989){1}[0-9]{9}+$/',
                'zero'         => '/^(09){1}[0-9]{9}+$/',
                'without_zero' => '/^(9){1}[0-9]{9}+$/',
            ];

            if (isset($parameters[0]) && in_array($parameters[0], array_keys($paramsPatternMap))) {
                return preg_match($paramsPatternMap[$parameters[0]], $value);
            }

            return preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || preg_match('/^(9){1}[0-9]{9}+$/', $value);
        });
    }
}
