<?php

declare(strict_types=1);

namespace App\Providers;

use App\AutoPayments\Application\Services\Orders\Contracts\PaymentOrdersServiceFabricInterface;
use App\AutoPayments\Application\Services\Orders\PaymentOrdersServiceFabric;
use App\AutoPayments\Application\Services\Transaction\Contracts\CreateTransactionServiceInterface;
use App\AutoPayments\Application\Services\Transaction\CreateTransactionService;
use Illuminate\Support\ServiceProvider;

class AutoPaymentsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        // Orders
        PaymentOrdersServiceFabricInterface::class => PaymentOrdersServiceFabric::class,
        // Transactions
        CreateTransactionServiceInterface::class => CreateTransactionService::class,
    ];
}