<?php

declare(strict_types=1);

namespace App\Providers;

use App\AutoPayments\Application\UseCases\AutoPayment\HandleAutoPaymentsService;
use App\AutoPayments\Application\UseCases\Contracts\HandleAutoPaymentsServiceInterface;
use Illuminate\Support\ServiceProvider;

class AutoPaymentsUseCaseProvider extends ServiceProvider
{
    public array $bindings = [
        HandleAutoPaymentsServiceInterface::class => HandleAutoPaymentsService::class,
    ];
}