<?php

use App\Space\Sms\Drivers\KavenegarSmsDriver;
use App\Space\Sms\Drivers\LocalSmsDriver;

return [
    /*
    |--------------------------------------------------------------------------
    | Default Sms Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default sms driver that is used to send any sms
    | messages sent by your application. Alternative drivers may be setup
    | and used as needed; however, this sms driver will be used by default.
    |
    */

    'default' => env('SMS_DRIVER', 'kavenegar'),

    'drivers' => [
        'kavenegar' => [
            'apikey'   => env('KAVENEGAR_API_KEY'),
            'insecure' => env('KAVENEGAR_INSECURE', false),
            'driver'   => KavenegarSmsDriver::class,
            'line'     => '10008663',
        ],
        'local'     => [
            'driver' => LocalSmsDriver::class,
        ]
    ],
];
