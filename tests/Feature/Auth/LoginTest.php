<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('can user login', function () {
    User::factory()->create([
        'mobile'   => $mobile = '09128909090',
        'password' => Hash::make('secret'),
    ]);

    $response = $this->post(route('auth.login'), [
        'mobile'   => $mobile,
        'password' => 'secret',
    ]);

    $response->assertSuccessful()->assertJsonStructure([
        'data' => [
            'token',
        ]
    ]);
});

it('cannot user login with invalid mobile', function () {
    $response = $this->post(route('auth.login'), [
        'mobile'   => '0912817787',
        'password' => 'secret',
    ]);

    $response->assertJsonValidationErrors([
        'mobile' => __('validation.ir_mobile'),
    ]);
});
