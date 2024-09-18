<?php

declare(strict_types=1);

namespace App\AutoPayments\Infrastructure\Repositories\SQL\PaymentRules;

use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetPaymentRulesRepositoryInterface;
use App\Exceptions\Infrastructure\DBException;
use Illuminate\Support\Collection;
use Throwable;

use App\Models\PaymentRule;

final readonly class GetPaymentRulesFromEloquentRepository implements GetPaymentRulesRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(): Collection
    {
        try {
            return PaymentRule::all();
        } catch(Throwable $e) {
            throw new DBException('', 0, $e);
        }
    }
}