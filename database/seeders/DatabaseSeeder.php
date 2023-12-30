<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\TransactionStatus;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $fakeCount = 20;

        for ($i = 1; $i < $fakeCount; $i++)
            Transaction::factory()
                ->for(CreditCard::factory()->for(Account::factory()->for(User::factory())), 'srcCreditCard')
                ->for(CreditCard::factory()->for(Account::factory()->for(User::factory())), 'dstCreditCard')
                ->count(15)
                ->create([
                    'status'     => TransactionStatus::Success,
                    'created_at' => now(),
                ]);
    }
}
