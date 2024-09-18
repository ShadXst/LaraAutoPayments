<?php

declare(strict_types=1);

namespace App\Exceptions\Infrastructure;

use RuntimeException;

/**
 * Абстрактный класс исключений инфраструктурного слоя.
 */
abstract class AbstractInfrastructureException extends RuntimeException
{
}
