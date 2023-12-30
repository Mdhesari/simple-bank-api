<?php

namespace App\DTO;

use Carbon\Carbon;

class UserTransactionFilterDTO
{
    public function __construct(
        public Carbon $datetime,
        public int    $count = 10,
        public int    $limit = 3,
    )
    {
        //
    }
}
