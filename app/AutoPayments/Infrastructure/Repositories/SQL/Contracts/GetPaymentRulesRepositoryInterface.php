<?php

namespace App\AutoPayments\Infrastructure\Repositories\SQL\Contracts;

use Illuminate\Support\Collection;

interface GetPaymentRulesRepositoryInterface
{
    public function get(): Collection;
}