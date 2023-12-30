<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\TransactionStatus;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'mobile'   => '09129008080',
            'password' => Hash::make('secret@123'),
        ]);

        $account = Account::factory()->create([
            'user_id' => $user->id,
        ]);
        CreditCard::factory()->create([
            'card_number' => '6219861254320054',
            'account_id'  => $account->id,
        ]);

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
