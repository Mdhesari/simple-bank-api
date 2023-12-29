<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Log\LogManager;

class TransactionObserver
{
    public function __construct(
        private LogManager $logManager,
    )
    {
        //
    }

    public function created(Transaction $transaction)
    {
        if ($transaction->isSuccess()) {
            $res = $transaction->srcAccount->decreaseBalance($transaction->quantity);
            if (! $res) {
                $this->logManager->critical("Could not decrease source account balance after transaction created.");
            }

            $transaction->dstAccount->increaseBalance($transaction->quantity);
            if (! $res) {
                $this->logManager->critical("Could not increase destination account balance after transaction created.");
            }
        }
    }
}
