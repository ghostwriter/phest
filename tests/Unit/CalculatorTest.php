<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ghostwriter\Phest\Attribute\FloatGenerator;
use Ghostwriter\Phest\Attribute\IntGenerator;
use Ghostwriter\Phest\Attribute\StringGenerator;
use Ghostwriter\Phest\Calculator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Tests\DataProvider\CalculatorDataProvider;

use function strlen;

#[CoversClass(Calculator::class)]
final class CalculatorTest extends AbstractPhestTestCase
{
    #[DataProviderExternal(CalculatorDataProvider::class, 'provideData')]
    public function testAddIsAssociative(
        #[IntGenerator(0, 999)]
        int $left,
        #[IntGenerator]
        int $middle,
        #[IntGenerator(0, 1)]
        int $right
    ): void {
        $calculator = new Calculator();

        self::assertSame(
            $calculator->add($left, $calculator->add($middle, $right)),
            $calculator->add($calculator->add($left, $middle), $right)
        );
    }

    #[DataProviderExternal(CalculatorDataProvider::class, 'provideData')]
    public function testAddIsCommutative(#[IntGenerator] int $left, #[IntGenerator(0, 999)] int $right): void
    {
        $calculator = new Calculator();

        self::assertSame($calculator->add($left, $right), $calculator->add($right, $left));
    }

    /**
     * @ignore PhpCsFixer\Fixer\Alias\MbStrFunctionsFixer
     */
    #[DataProviderExternal(CalculatorDataProvider::class, 'provideData')]
    public function testString(
        #[StringGenerator(length: 1)]
        string $left,
        #[StringGenerator]
        string $middle,
        #[StringGenerator(length: 10)]
        string $right
    ): void {
        self::assertIsString($left);
        self::assertIsString($middle);
        self::assertIsString($right);

        self::assertNotSame($left, $middle);
        self::assertNotSame($left, $right);
        self::assertNotSame($middle, $right);

        self::assertSame(1000, strlen($middle)); // 1000 is the default max length
        self::assertSame(10, strlen($right)); // 10 is the provided max length
        self::assertSame(1, strlen($left)); // 1 is the provided length
    }

    #[DataProviderExternal(CalculatorDataProvider::class, 'provideData')]
    public function testSubtractIsNotCommutative(
        #[FloatGenerator]
        float $left,
        #[IntGenerator(0, 999)]
        int $right
    ): void {
        $calculator = new Calculator();

        self::assertNotSame($calculator->subtract($left, $right), $calculator->subtract($right, $left));
    }
}
