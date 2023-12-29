<?php

namespace App\Traits;

trait EnumToArray
{
    public static function toArray(): array
    {
        return array_column(self::cases(), 'name');
    }
}
