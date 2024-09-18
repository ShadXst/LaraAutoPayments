<?php

declare(strict_types=1);

namespace App\AutoPayments\Application\Services\Orders;

use App\AutoPayments\Application\Services\Orders\Contracts\PaymentOrdersServiceInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetSingularPaymentOrdersRepositoryInterface;
use App\Models\PaymentRule;
use Illuminate\Support\Collection;
use Throwable;

final readonly class SingularPaymentOrdersService implements PaymentOrdersServiceInterface
{
    public function __construct(private GetSingularPaymentOrdersRepositoryInterface $getSingularPaymentOrdersRepository) {
    }

    /**
     * @inheritDoc
     */
    public function getOrders(PaymentRule $rule): Collection
    {
        try {
            return $this->getSingularPaymentOrdersRepository->get($rule);
        } catch (Throwable $e) {
            // Throw Application exception
        }
    }
}