<?php

namespace App\AutoPayments\Infrastructure\Repositories\SQL\Contracts;

use App\Models\Order;
use App\Models\PaymentRule;
use Illuminate\Support\Collection;

interface GetSingularPaymentOrdersRepositoryInterface
{
    /**
     * Получить список заказов для одиночных списаний.
     * @return Collection<Order>
     */
    public function get(PaymentRule $rule): Collection;
}