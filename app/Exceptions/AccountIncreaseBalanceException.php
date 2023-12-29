<?php

namespace App\Exceptions;

use Exception;

class AccountIncreaseBalanceException extends Exception
{
    protected $code = 500;

    protected $message = "Could not decrease source account balance after transaction created.";
}
