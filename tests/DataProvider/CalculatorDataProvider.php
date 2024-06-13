<?php

declare(strict_types=1);

namespace Tests\DataProvider;

use Ghostwriter\Phest\Attribute\BoolGenerator;
use Ghostwriter\Phest\Attribute\FloatGenerator;
use Ghostwriter\Phest\Attribute\IntGenerator;
use Ghostwriter\Phest\Attribute\StringGenerator;
use Ghostwriter\Phest\Exception\FailedToDetermineTestClassException;
use Ghostwriter\Phest\Interface\AttributeInterface;
use Random\Engine\Mt19937;
use Random\Randomizer;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionParameter;
use Throwable;

use function array_fill;
use function count;
use function debug_backtrace;

final readonly class CalculatorDataProvider
{
    /**
     * @throws Throwable
     *
     * @return iterable<array<int>>
     */
    public static function provideData(): iterable
    {
        $engine = new Mt19937();
        $randomizer = new Randomizer($engine);
        $backtrace = debug_backtrace(0, 4);

        [$testReflectionClass, $testMethodName] = $backtrace[3]['args'];
        if (! $testReflectionClass instanceof ReflectionClass) {
            throw new FailedToDetermineTestClassException($testMethodName);
        }

        $testMethod = $testReflectionClass->getMethod($testMethodName);
        $parameters = $testMethod->getParameters();
        $totalParameters = count($parameters);
        $data = array_fill(0, $totalParameters, null);

        foreach ($parameters as $i => $parameter) {
            if (! $parameter instanceof ReflectionParameter) {
                continue;
            }

            foreach (
                $parameter->getAttributes(AttributeInterface::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute
            ) {
                $instance = $attribute->newInstance();

                $data[$i] = match (true) {
                    $instance instanceof StringGenerator => match ($instance->length) {
                        0 => '',
                        default => $randomizer->getBytes($instance->length)
                    },
                    $instance instanceof FloatGenerator => $randomizer->getFloat($instance->min, $instance->max),
                    $instance instanceof IntGenerator => $randomizer->getInt($instance->min, $instance->max),
                    $instance instanceof BoolGenerator => $randomizer->getInt(0, 1),
                    default => null,
                };
                continue 2;
            }
            // TODO: If we want to build and pass objects by type hints to the test method parameters, we can do so here.
            // $typeHint = $parameter->getType()?->getName() ?? '';
        }

        yield $data;
    }
}
