<?php

namespace App\AutoPayments\Application\Feature\Orders\Contracts;

use Illuminate\Support\Collection;

interface GetPaymentOrdersFeatureInterface
{
    public function __invoke(): Collection;
}