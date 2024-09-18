<?php

declare(strict_types=1);

namespace App\AutoPayments\Application\Feature\Orders;

use App\AutoPayments\Application\Feature\Orders\Contracts\GetPaymentOrdersFeatureInterface;
use App\AutoPayments\Application\Services\Orders\Contracts\PaymentOrdersServiceFabricInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetPaymentRulesRepositoryInterface;
use Illuminate\Support\Collection;
use Throwable;

final readonly class GetPaymentOrdersFeature implements GetPaymentOrdersFeatureInterface
{
    public function __construct(
        private GetPaymentRulesRepositoryInterface $getPaymentRulesRepository,
        private PaymentOrdersServiceFabricInterface $paymentOrdersServiceFabric,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function __invoke(): Collection
    {
        try {
            $rules = $this->getPaymentRulesRepository->get();
 
            $orders = collect();
            foreach ($rules as $rule) {
                $orders->concat(
                    $this->paymentOrdersServiceFabric
                        ->getInstance($rule->type)
                        ->getOrders($rule)
                );
            }

            return $orders;
        } catch (Throwable $e) {
            // Throw Application exception
        }
    }
}