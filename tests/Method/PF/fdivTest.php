<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class fdivTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @covers \Symfony\Polyfill\Php80\Php80::fdiv
     *
     * @dataProvider fdivProvider
     */
    function testFdiv($expected, $divident, $divisor)
    {
        try {
            $result = PF::fdiv($divident, $divisor);
        } catch (\DivisionByZeroError $e) {
            $result = $expected;
        }
        $this->assertSame($expected, $result);
        // Cast to string to detect negative zero "-0"
        $this->assertSame((string) $expected, (string) $result);
    }

    /**
     * @covers \Symfony\Polyfill\Php80\Php80::fdiv
     *
     * @dataProvider nanFdivProvider
     */
    function testFdivNan($divident, $divisor)
    {
        try {
            $this->assertNan(PF::fdiv($divident, $divisor));
        } catch (\DivisionByZeroError $e) {
            $this->assertNan(\NAN);
        }
    }

    /**
     * @covers \Symfony\Polyfill\Php80\Php80::fdiv
     *
     * @dataProvider invalidFloatProvider
     */
    function testFdivTypeError($divident, $divisor)
    {
        $this->expectException('TypeError');
        PF::fdiv($divident, $divisor);
    }

    static function nanFdivProvider()
    {
        return [
            [0.0, 0.0],
            [0.0, -0.0],
            [-0.0, 0.0],
            [-0.0, -0.0],
            [\INF, \INF],
            [\INF, -\INF],
            [-\INF, \INF],
            [-\INF, -\INF],
            [\NAN, \NAN],
            [\INF, \NAN],
            [-0.0, \NAN],
            [\NAN, \INF],
            [\NAN, 0.0],
        ];
    }

    public static function fdivProvider()
    {
        return [
            [10 / 3, '10', '3'],
            [10 / 3, 10.0, 3.0],
            [-4.0, -10.0, 2.5],
            [-4.0, 10.0, -2.5],
            [\INF, 10.0, 0.0],
            [-\INF, 10.0, -0.0],
            [-\INF, -10.0, 0.0],
            [\INF, -10.0, -0.0],
            [\INF, \INF, 0.0],
            [-\INF, \INF, -0.0],
            [-\INF, -\INF, 0.0],
            [\INF, -\INF, -0.0],
            [0.0, 0.0, \INF],
            [-0.0, 0.0, -\INF],
            [-0.0, -0.0, \INF],
            [0.0, -0.0, -\INF],
        ];
    }

    static function invalidFloatProvider()
    {
        return [
            ['invalid', 1.0],
            ['invalid', 'invalid'],
            [1.0, 'invalid'],
        ];
    }
}
