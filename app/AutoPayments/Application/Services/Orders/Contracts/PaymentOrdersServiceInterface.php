<?php

namespace App\AutoPayments\Application\Services\Orders\Contracts;

use App\Models\PaymentRule;
use Illuminate\Support\Collection;

interface PaymentOrdersServiceInterface
{
    public function getOrders(PaymentRule $rule): Collection;
}