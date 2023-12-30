<?php

namespace App\Http\Controllers\Account;

use App\DTO\CreditCardFilterDTO;
use App\DTO\TransactionDTO;
use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountDepositRequest;
use App\Http\Resources\ResponseResource;
use App\Services\CreditCardService;
use App\Services\TransactionService;
use Illuminate\Validation\ValidationException;

class DepositController extends Controller
{
    public function __construct(
        private TransactionService $transactionSrv,
        private CreditCardService  $creditCardService,
    )
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Handle the incoming request.
     * @throws ValidationException
     */
    public function __invoke(AccountDepositRequest $request): ResponseResource
    {
        $srcCreditCard = $this->creditCardService->getCreditCards(new CreditCardFilterDTO($request->src_card_number));
        $dstCreditCard = $this->creditCardService->getCreditCards(new CreditCardFilterDTO($request->dst_card_number));

        $transaction = $this->transactionSrv->deposit(new TransactionDTO(
            $request->quantity,
            TransactionStatus::Success, //TODO: this maybe change for validating the transaction in future
            $srcCreditCard->first()->id,
            $dstCreditCard->first()->id,
        ));

        return new ResponseResource([
            'item' => $transaction,
        ]);
    }
}
