<?php

namespace App\Observers;

use App\DTO\AccountBalanceDTO;
use App\Models\Transaction;
use App\Services\AccountService;

class TransactionObserver
{
    public function __construct(
        private AccountService $accountSrv,
    )
    {
        //
    }

    public function created(Transaction $transaction)
    {
        if ($transaction->isSuccess()) {
            $this->accountSrv->decreaseBalance(new AccountBalanceDTO(
                $transaction->src_account_id,
                $transaction->quantity_with_fee,
                $transaction->total_fee,
            ));

            $this->accountSrv->increaseBalance(new AccountBalanceDTO(
                $transaction->dst_account_id,
                $transaction->quantity
            ));
        }
    }
}
