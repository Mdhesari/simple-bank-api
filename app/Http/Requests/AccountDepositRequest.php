<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use App\Rules\IrCreditCard;
use Illuminate\Foundation\Http\FormRequest;

class AccountDepositRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'src_card_number' => ['required', new IrCreditCard],
            'dst_card_number' => ['required', new IrCreditCard],
            'quantity'        => ['numeric', 'min:'.Transaction::MIN_TRANSACTION_QUANTITY, 'max:'.Transaction::MAX_TRANSACTION_QUANTITY],
        ];
    }
}
