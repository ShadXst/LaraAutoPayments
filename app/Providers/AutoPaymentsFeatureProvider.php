<?php

declare(strict_types=1);

namespace App\Providers;

use App\AutoPayments\Application\Feature\Contracts\GetPaymentOrdersFeatureInterface;
use App\AutoPayments\Application\Feature\Orders\GetPaymentOrdersFeature;
use Illuminate\Support\ServiceProvider;

class AutoPaymentsFeatureProvider extends ServiceProvider
{
    public array $bindings = [
        GetPaymentOrdersFeatureInterface::class => GetPaymentOrdersFeature::class,
    ];
}