<?php

declare(strict_types=1);

namespace Ghostwriter\PhestTests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Ghostwriter\Phest\Calculator;
use Ghostwriter\PhestTests\DataProvider\CalculatorDataProvider;

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
