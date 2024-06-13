<?php

declare(strict_types=1);

namespace Ghostwriter\Phest\Exception;

use Ghostwriter\Phest\Interface\ExceptionInterface;
use InvalidArgumentException;

final class FailedToDetermineTestClassException extends InvalidArgumentException implements ExceptionInterface
{
}
