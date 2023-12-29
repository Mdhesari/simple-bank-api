<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AccountType
{
    use EnumToArray;

    case Deposit;
    case Saving;
    // Add more types...
}
