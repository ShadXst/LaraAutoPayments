<?php

declare(strict_types=1);

namespace App\Exceptions\Application;

use RuntimeException;

/**
 * Абстрактный класс для ошибок в логике.
 */
abstract class AbstractLogicException extends RuntimeException
{
}
