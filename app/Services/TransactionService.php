<?php

namespace App\Services;

use App\DTO\AccountBalanceDTO;
use App\DTO\CreditCardBalance;
use App\DTO\TransactionDTO;
use App\DTO\TransactionFeeDTO;
use App\Events\TransactionCreated;
use App\Exceptions\AccountDecreaseBalanceException;
use App\Exceptions\AccountIncreaseBalanceException;
use App\Models\Transaction;
use App\Models\TransactionFee;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\CreditCardRepositoryInterface;
use App\Repositories\TransactionFeeRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    public function __construct(
        private AccountRepositoryInterface        $accountRepo,
        private CreditCardRepositoryInterface     $creditCardRepo,
        private TransactionRepositoryInterface    $transactionRepo,
        private TransactionFeeRepositoryInterface $transactionFeeRepo
    )
    {
        //
    }

    /**
     * @param TransactionDTO $dto
     * @return Transaction
     * @throws ValidationException
     */
    public function deposit(TransactionDTO $dto): \App\Models\Transaction
    {
        if (! $this->creditCardRepo->hasEnoughBalance(new CreditCardBalance($dto->quantity, $dto->srcCreditCardId))) {

            throw ValidationException::withMessages([
                'src_card_number' => __('validation.card_enough_balance'),
            ]);
        }

        $transaction = DB::transaction(function () use ($dto) {
            $transaction = $this->transactionRepo->deposit($dto);

            $this->createTransactionFee($transaction);

            $this->updateAccountBalance($transaction);

            return $transaction;
        });

        event(new TransactionCreated($transaction));

        return $transaction;
    }

    /**
     * @throws AccountIncreaseBalanceException
     * @throws AccountDecreaseBalanceException
     */
    private function updateAccountBalance(Transaction $transaction)
    {
        // We only increase the balance when transaction is succeeded
        if ($transaction->isSuccess()) {
            $dto = new AccountBalanceDTO(
                $transaction->srcCreditCard->account_id,
                $transaction->quantity_with_fee,
            );

            $res = $this->accountRepo->decreaseBalance($dto);
            if (! $res) {

                throw new AccountDecreaseBalanceException;
            }

            $dto = new AccountBalanceDTO(
                $transaction->dstCreditCard->account_id,
                $transaction->quantity
            );

            $res = $this->accountRepo->increaseBalance($dto);
            if (! $res) {

                throw new AccountIncreaseBalanceException;
            }
        }
    }

    private function createTransactionFee($transaction)
    {
        $this->transactionFeeRepo->create(new TransactionFeeDTO(
            TransactionFee::DEFAULT_FEE, $transaction->src_credit_card_id, $transaction->id,
        ));
    }
}
