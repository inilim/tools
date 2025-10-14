<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;

/**
 */
class bcdivmodTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @requires extension bcmath
     *
     * @covers \Symfony\Polyfill\Php84\Php84::bcdivmod
     *
     * @dataProvider bcDivModProvider
     */
    function testBcDivMod(string $num1, string $num2, ?int $scale, array $expected)
    {
        $this->assertSame($expected, PF::bcdivmod($num1, $num2, $scale));
    }

    /**
     * @requires extension bcmath
     */
    function testBcDivModDivideByZero()
    {
        // TODO в версии 74 вместо исключение вылетает ошибка, сам класс DivisionByZeroError::class имеется
        // https://github.com/symfony/polyfill/issues/548
        $this->expectException(\DivisionByZeroError::class);

        PF::bcdivmod('1', '0');
    }

    /**
     * @requires extension bcmath
     */
    function testBcDivModDivideByFloatingZero()
    {
        // TODO в версии 74 вместо исключение вылетает ошибка, сам класс DivisionByZeroError::class имеется
        // https://github.com/symfony/polyfill/issues/548
        $this->expectException(\DivisionByZeroError::class);

        PF::bcdivmod('1', '0.00');
    }

    /**
     * @requires PHP 8.0
     * @requires extension bcmath
     */
    function testBcDivModMalformedNumber()
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage('Argument #1 ($num1) is not well-formed');

        PF::bcdivmod('a', '1');
    }

    /**
     * @requires PHP 8.0
     * @requires extension bcmath
     */
    function testBcDivModMalformedNumber2()
    {
        $this->expectException(\Error::class);
        $this->expectExceptionMessage('Argument #2 ($num2) is not well-formed');

        PF::bcdivmod('1', 'a');
    }

    static function bcDivModProvider(): iterable
    {
        yield ['1', '1', null, ['1', '0']];
        yield ['1', '2', null, ['0', '1']];
        yield ['5', '2', null, ['2', '1']];
        yield ['5', '2', 0, ['2', '1']];
        yield ['5', '2', 1, ['2', '1.0']];
        yield ['5', '2', 2, ['2', '1.00']];
        yield ['7.2', '3', 2, ['2', '1.20']];
    }
}
