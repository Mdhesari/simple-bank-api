<?php

namespace App\Providers;

use App\Exceptions\SmsDriverIsNotFoundException;
use App\Space\Sms\Drivers\SmsDriverInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SmsDriverInterface::class, function (Application $app) {
            return $app->make($this->getDriverClass());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * @throws SmsDriverIsNotFoundException
     */
    private function getDriverClass()
    {
        $driver = config('sms.default');
        $driver = config('sms.drivers.'.$driver.'.driver');

        if (is_null($driver)) {

            throw new SmsDriverIsNotFoundException;
        }

        return $driver;
    }
}
