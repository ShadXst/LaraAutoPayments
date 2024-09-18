<?php

namespace App\Models;

use App\Enums\PaymentRuleTypeEnum;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentRule extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => PaymentRuleTypeEnum::class,
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
