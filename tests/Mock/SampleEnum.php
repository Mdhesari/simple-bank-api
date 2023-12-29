<?php

namespace Tests\Mock;

use App\Traits\EnumToArray;

enum SampleEnum
{
    use EnumToArray;

    case SampleCaseOne;
    case SampleCaseTwo;
}
