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

    protected function prepareForValidation()
    {
        return $this->merge([
            'quantity'        => $this->toEnglishNumbers($this->quantity),
            'src_card_number' => $this->toEnglishNumbers($this->src_card_number),
            'dst_card_number' => $this->toEnglishNumbers($this->dst_card_number),
        ]);
    }


    private function toEnglishNumbers(string $number)
    {
        $arabicDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $number = str_replace($arabicDigits, $englishDigits, $number);
        $number = str_replace($persinaDigits1, $englishDigits, $number);
        return str_replace($persinaDigits2, $englishDigits, $number);
    }
}
