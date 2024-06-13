<?php

declare(strict_types=1);

namespace Ghostwriter\Phest\Attribute;

use Attribute;
use Ghostwriter\Phest\Interface\AttributeInterface;

use const PHP_FLOAT_MAX;
use const PHP_FLOAT_MIN;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class FloatGenerator implements AttributeInterface
{
    public function __construct(
        public float $min = PHP_FLOAT_MIN,
        public float $max = PHP_FLOAT_MAX
    ) {
    }
}
