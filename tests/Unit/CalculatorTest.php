<?php

declare(strict_types=1);

namespace Ghostwriter\Phest\Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;

#[CoversClass(Calculator::class)]
final class CalculatorTest extends AbstractPhestTestCase
{
    #[DataProviderExternal(CalculatorDataProvider::class, 'provide')]
    public function testAddition(int $left, int $right): void
    {
        $calculator = new Calculator();

        self::assertSame($calculator->add($left, $right), $calculator->add($right, $left));
    }
}

final class Calculator
{
    public function add(int $left, int $right): int
    {
        return $left + $right;
    }
}

final class CalculatorDataProvider
{
    public static function provide(): iterable
    {
        yield [1, 2];
        yield [2, 3];
        yield [3, 4];
    }
}
