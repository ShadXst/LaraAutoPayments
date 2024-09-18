<?php
declare(strict_types=1);

namespace App\Console\Commands\AutoPayments;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

final class AutoPaymentsCommand extends Command
{
    protected $signature = 'auto-payments:run';

    protected $description = 'Запустить процесс выполнения автооплаты';

    public function handle(): int
    {
        try {
            Log::info('Команда выполнена');
        } catch (Throwable $e) {
            $this->error('Ошибка при исполнении автооплаты.');

            return self::FAILURE;
        }

        $this->info('Автооплата выполнена');

        return self::SUCCESS;
    }
}