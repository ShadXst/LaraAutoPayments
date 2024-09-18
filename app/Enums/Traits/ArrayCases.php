<?php

namespace App\Enums\Traits;

trait ArrayCases
{
    public static function toArray(): array
    {
        return array_column(static::cases(), 'value', 'value');
    }
}
