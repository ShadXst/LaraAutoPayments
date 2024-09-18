<?php

namespace App\AutoPayments\Application\Services\Orders\Contracts;
use App\Enums\PaymentRuleTypeEnum;

interface PaymentOrdersServiceFabricInterface
{
    public function getInstance(PaymentRuleTypeEnum $paymentRuleType): PaymentOrdersServiceInterface;
}