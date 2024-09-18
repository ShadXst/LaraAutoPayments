<?php

declare(strict_types=1);

namespace App\Console\Commands\AutoPayments;

use App\AutoPayments\Application\UseCases\Contracts\HandleAutoPaymentsServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

final class RunAutoPaymentsCommand extends Command
{
    protected $signature = 'auto-payments:run';

    protected $description = 'Запустить процесс выполнения автооплаты';

    public function handle(HandleAutoPaymentsServiceInterface $handleAutoPaymentsService): int
    {
        try {
            $handleAutoPaymentsService->handle();
        } catch (Throwable $e) {
            Log::critical($e->getTraceAsString(), [
                'message' => $e->getMessage(),
            ]);

            $this->error('Ошибка автооплаты.');

            return self::FAILURE;
        }

        $this->info('Автооплата выполнена');

        return self::SUCCESS;
    }
}