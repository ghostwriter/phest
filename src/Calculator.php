<?php

declare(strict_types=1);

namespace Ghostwriter\Phest;

/** @see CalculatorTest */
final class Calculator
{
    public function add(int $left, int $right): int
    {
        return $left + $right;
    }
}
