<?php

declare(strict_types=1);

namespace App\AutoPayments\Infrastructure\Repositories\SQL\Orders;

use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetSingularPaymentOrdersRepositoryInterface;
use App\Exceptions\Infrastructure\DBException;
use App\Models\Order;
use App\Models\PaymentRule;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Database\Query\Builder;
use Throwable;

final readonly class GetSingularPaymentOrdersFromEloquentRepository implements GetSingularPaymentOrdersRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(PaymentRule $rule): Collection
    {
        try {
            return Order::query()
                ->whereDoesntHave('transaction', function (Builder $query) use ($rule) {
                    $query->where('transaction.rule_id', '=', $rule->id);
                })
                ->where('created_at', '<=', now()->subMinutes($rule->delay))
                ->get();
        } catch (Throwable $e) {
            throw new DBException('Не удалось получить заказы ...', 0, $e);
        }
    }
}