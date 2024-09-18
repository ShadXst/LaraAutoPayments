<?php

declare(strict_types=1);

namespace App\AutoPayments\Infrastructure\Repositories\SQL\Transactions;

use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\CreateTransactionFromOrderRepositoryInterface;
use App\Exceptions\Infrastructure\DBException;
use App\Models\Order;
use App\Models\Transaction;
use Throwable;

final readonly class CreateTransactionFromOrderFromEloquentRepository implements CreateTransactionFromOrderRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(Order $order): Transaction
    {
        try {
            return new Transaction();
        } catch(Throwable $e) {
            throw new DBException('', 0, $e);
        }
    }
}