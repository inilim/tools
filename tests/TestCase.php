<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\Test\Tag\AssertTag;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\ExpectationFailedException;

class TestCase extends \PHPUnit\Framework\TestCase
{
    static function setUpBeforeClass(): void
    {
        require_once __DIR__ . '/../bootstrap.dev.php';
    }

    // function assertProcess(AssertTag $assert)
    // {
    //     if (!$assert->getStatus()) {
    //         $failureDescription = sprintf(
    //             'Failed asserting that %s.',
    //             $assert->getActual(),
    //         );
    //         throw new ExpectationFailedException($failureDescription);
    //     }
    // }

    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     *
     * @psalm-template ExpectedType
     *
     * @psalm-param ExpectedType $expected
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     * @throws ExpectationFailedException
     *
     * @psalm-assert =ExpectedType $actual
     */
    public static function assertProcess(AssertTag $assert): void
    {
        static::assertThat(
            true,
            new IsIdentical($assert->getStatus()),
            $assert->getMessage(),
        );
    }
}
