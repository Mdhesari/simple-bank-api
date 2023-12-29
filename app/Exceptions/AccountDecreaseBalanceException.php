<?php

namespace App\Exceptions;

use Exception;

class AccountDecreaseBalanceException extends Exception
{
    protected $code = 500;

    protected $message = "Could not decrease source account balance after transaction created.";
}
