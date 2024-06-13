<?php

declare(strict_types=1);

namespace Ghostwriter\Phest\Attribute;

use Attribute;
use Ghostwriter\Phest\Interface\AttributeInterface;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class StringGenerator implements AttributeInterface
{
    public function __construct(
        public int $length = 1000
    ) {
    }
}
