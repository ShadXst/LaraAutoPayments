<?php

namespace App\AutoPayments\Application\Services\Transactions\Contracts;

use App\Models\Order;
use App\Models\Transaction;

interface CreateTransactionServiceInterface
{
    public function create(Order $order): Transaction;
}