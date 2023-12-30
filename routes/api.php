<?php

use App\Http\Controllers\Account\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Health\PingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/health/ping', PingController::class)->name('health.ping');

Route::post('auth/login', LoginController::class)->name('auth.login');

Route::post('accounts/deposit', DepositController::class)->name('account.deposit');
