<?php

namespace App\Models;

use App\Enums\PaymentRuleTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRule extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => PaymentRuleTypeEnum::class,
    ];
}
