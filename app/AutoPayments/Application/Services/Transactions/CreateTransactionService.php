<?php

declare(strict_types=1);

namespace App\AutoPayments\Application\Services\Transactions;

use App\AutoPayments\Application\Services\Transactions\Contracts\CreateTransactionServiceInterface;
use App\AutoPayments\Infrastructure\Repositories\SQL\Contracts\CreateTransactionFromOrderRepositoryInterface;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Throwable;

final readonly class CreateTransactionService implements CreateTransactionServiceInterface
{
    public function __construct(private CreateTransactionFromOrderRepositoryInterface $createTransactionFromOrderRepository) {
    }
    
    /**
     * @inheritDoc
     */
    public function create(Order $order): Transaction
    {
        try {
            $this->createTransactionFromOrderRepository->create($order);

            Log::info('Транзакция успешно создана');
        } catch (Throwable $e) {
            // throw Application exception
        }
    }
}