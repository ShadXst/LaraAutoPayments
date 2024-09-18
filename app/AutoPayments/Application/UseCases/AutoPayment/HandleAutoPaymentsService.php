<?php

declare(strict_types=1);

namespace App\AutoPayments\Application\UseCases\AutoPayment;

use App\AutoPayments\Application\Feature\Orders\Contracts\GetPaymentOrdersFeatureInterface;
use App\AutoPayments\Application\Services\Transactions\Contracts\CreateTransactionServiceInterface;
use App\AutoPayments\Application\UseCases\Contracts\HandleAutoPaymentsServiceInterface;
use Throwable;

final readonly class HandleAutoPaymentsService implements HandleAutoPaymentsServiceInterface
{
    public function __construct(
        private GetPaymentOrdersFeatureInterface $getPaymentOrders,
        private CreateTransactionServiceInterface $createTransactionService,
    ) {

    }

    /**
     * @inheritDoc
     */
    public function handle(): void
    {
        try {
            $orders = ($this->getPaymentOrders)();

            foreach ($orders as $order)
            {
                $this->createTransactionService->create($order);
            }
        } catch (Throwable $e) {
            // Throw Application exception
        }
    }
}