<?php

declare(strict_types=1);

namespace App\Exceptions\Application;

use RuntimeException;

/**
 * Абстрактная ошибка слоя приложения.
 */
abstract class AbstractApplicationException extends RuntimeException
{
}
