<?php

declare(strict_types=1);

namespace App\AutoPayments\Infrastructure\Repositories\SQL\Orders;

use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetRepeteablePaymentOrdersRepositoryInterface;
use App\Exceptions\Infrastructure\DBException;
use App\Models\Order;
use App\Models\PaymentRule;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Collection;
use Throwable;

final readonly class GetRepeatablePaymentOrdersFromEloquentRepository implements GetRepeteablePaymentOrdersRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(PaymentRule $rule): Collection
    {
        $periodCheckDate = now()->subDays($rule->period);
        try {
            return Order::query()
                ->whereDoesntHave('transactions', function (Builder $query) use ($rule) {
                    $query->where('transactions.payment_rule_id', $rule->id);
                })
                ->where('created_at', '<=', $periodCheckDate)
                ->get();
        } catch (Throwable $e) {
            throw new DBException('Failed to retrieve repeatable payment orders', 0, $e);
        }
    }
}