<?php

declare(strict_types=1);

namespace App\Providers;

use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\CreateTransactionFromOrderRepositoryInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetPaymentRulesRepositoryInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetRepeteablePaymentOrdersRepositoryInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\GetSingularPaymentOrdersRepositoryInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Orders\GetRepeatablePaymentOrdersFromEloquentRepository;
use App\AutoPayments\Infrastructure\Repositories\SQL\Orders\GetSingularPaymentOrdersFromEloquentRepository;
use App\AutoPayments\Infrastructure\Repositories\SQL\PaymentRules\GetPaymentRulesFromEloquentRepository;
use App\AutoPayments\Infrastructure\Repositories\SQL\Transactions\CreateTransactionFromOrderFromEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AutoPaymentsRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        GetPaymentRulesRepositoryInterface::class => GetPaymentRulesFromEloquentRepository::class,
        GetSingularPaymentOrdersRepositoryInterface::class => GetSingularPaymentOrdersFromEloquentRepository::class,
        GetRepeteablePaymentOrdersRepositoryInterface::class => GetRepeatablePaymentOrdersFromEloquentRepository::class,
        CreateTransactionFromOrderRepositoryInterface::class => CreateTransactionFromOrderFromEloquentRepository::class,
    ];
}