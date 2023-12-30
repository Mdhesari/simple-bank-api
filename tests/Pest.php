<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Enums\TransactionStatus;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transaction;
use App\Models\TransactionFee;
use App\Models\User;
use App\Repositories\Eloquent\AccountRepository;
use App\Repositories\Eloquent\CreditCardRepository;
use App\Repositories\Eloquent\TransactionFeeRepository;
use App\Repositories\Eloquent\TransactionRepository;
use App\Services\AccountService;
use App\Services\TransactionService;

uses(
    Tests\TestCase::class,
// Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createUser(array $data = [])
{
    return User::factory()->has(Account::factory()->has(CreditCard::factory()))->create($data);
}

function createUserWithTransactions(array $data = [])
{
    return User::factory()->has(
        Account::factory()->has(
            CreditCard::factory()->has(
                Transaction::factory()->for(CreditCard::factory()->for(Account::factory()->for(User::factory())), 'srcCreditCard'),
                'deposits'
            )->has(
                Transaction::factory()->for(CreditCard::factory()->for(Account::factory()->for(User::factory())), 'dstCreditCard'),
                'withdraws',
            )
        )
    )->create($data);
}

function createTransaction(array $data = [], $count = 15)
{
    return Transaction::factory()
        ->for(CreditCard::factory()->for(Account::factory()->for(User::factory())), 'srcCreditCard')
        ->for(CreditCard::factory()->for(Account::factory()->for(User::factory())), 'dstCreditCard')
        ->count($count)
        ->create([
            'status'     => TransactionStatus::Success,
            'created_at' => now(),
        ]);
}

function getAccountService(): AccountService
{
    return new AccountService(
        new AccountRepository(app(Account::class))
    );
}

function getTransactionService(): TransactionService
{
    return new TransactionService(
        new AccountRepository(app(Account::class)),
        new CreditCardRepository(app(CreditCard::class)),
        new TransactionRepository(app(Transaction::class)),
        new TransactionFeeRepository(app(TransactionFee::class)),
    );
}
