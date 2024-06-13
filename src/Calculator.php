<?php

declare(strict_types=1);

namespace Ghostwriter\Phest;

/** @see CalculatorTest */
final class Calculator
{
    public function add(float|int $left, float|int $right): float|int
    {
        return $left + $right;
    }

    public function subtract(float|int $left, float|int $right): float|int
    {
        return $left - $right;
    }
}
