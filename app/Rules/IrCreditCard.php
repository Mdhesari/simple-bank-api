<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IrCreditCard implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^\d{16}$/', $value)) {
            $fail(__('validation.ir_credit_card'));
        }
    }
}
