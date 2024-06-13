<?php

declare(strict_types=1);

namespace Ghostwriter\Phest\Attribute;

use Attribute;
use Ghostwriter\Phest\Interface\AttributeInterface;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class IntGenerator implements AttributeInterface
{
    public function __construct(
        public int $min = PHP_INT_MIN,
        public int $max = PHP_INT_MAX
    ) {
    }
}
