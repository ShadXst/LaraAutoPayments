<?php

namespace App\AutoPayments\Application\UseCases\Contracts;

interface HandleAutoPaymentsServiceInterface
{
    public function handle(): void;
}