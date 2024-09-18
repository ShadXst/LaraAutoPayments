<?php

namespace App\Models;

use App\Models\Order;
use App\Models\PaymentRule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function paymentRule(): BelongsTo
    {
        return $this->belongsTo(PaymentRule::class);
    }
}
