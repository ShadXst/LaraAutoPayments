<?php

declare(strict_types=1);

namespace App\AutoPayments\Application\Services\Orders;

use App\AutoPayments\Application\Services\Orders\Contracts\PaymentOrdersServiceFabricInterface;
use App\AutoPayments\Application\Services\Orders\Contracts\PaymentOrdersServiceInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetRepeteablePaymentOrdersRepositoryInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetSingularPaymentOrdersRepositoryInterface;
use App\Enums\PaymentRuleTypeEnum;
use Exception;

final readonly class PaymentOrdersServiceFabric implements PaymentOrdersServiceFabricInterface
{
    public function __construct(
        private GetSingularPaymentOrdersRepositoryInterface $getSingularPaymentOrdersRepository,
        private GetRepeteablePaymentOrdersRepositoryInterface $getRepeatablePaymentOrdersRepository,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getInstance(PaymentRuleTypeEnum $paymentRuleType): PaymentOrdersServiceInterface
    {
        return match ($paymentRuleType) {
            PaymentRuleTypeEnum::SINGULAR => new SingularPaymentOrdersService($this->getSingularPaymentOrdersRepository),
            PaymentRuleTypeEnum::REPEATABLE => new RepeatablePaymentOrdersService($this->getRepeatablePaymentOrdersRepository),
            default => throw new Exception('Неизвестный тип правила автооплаты'),
        };
    }
}