<?php

declare(strict_types=1);

namespace Ghostwriter\PhestTests\DataProvider;

final class CalculatorDataProvider
{
    /**
     * @return iterable<array<int>>
     */
    public static function provide(): iterable
    {
        yield [1, 2];
        yield [2, 3];
        yield [3, 4];
    }
}
