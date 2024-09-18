<?php

namespace App\Enums;

use App\Enums\Traits\ArrayCases;

enum PaymentRuleTypeEnum: string
{
    use ArrayCases;

    case SINGULAR = 'singular';
    case REPEATABLE = 'repeatable';
}