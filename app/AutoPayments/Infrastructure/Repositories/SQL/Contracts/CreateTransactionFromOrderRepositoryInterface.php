<?php

namespace App\AutoPayments\Infrastructure\Repositories\SQL\Contracts;

use App\Models\Order;
use App\Models\Transaction;

interface CreateTransactionFromOrderRepositoryInterface
{
    public function create(Order $order): Transaction;
}