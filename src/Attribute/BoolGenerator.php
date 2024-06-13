<?php

declare(strict_types=1);

namespace Ghostwriter\Phest\Attribute;

use Attribute;
use Ghostwriter\Phest\Interface\AttributeInterface;

#[Attribute(Attribute::TARGET_PARAMETER)]
final class BoolGenerator implements AttributeInterface
{
    public function __construct(
        public bool $value = false
    ) {
    }
}
