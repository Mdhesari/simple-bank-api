<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TransactionStatus
{
    use EnumToArray;

    case Success;
    case Pending;
    case Failed;
    // we could have other cases like BankPending, etc
}
