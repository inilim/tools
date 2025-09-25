<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use Inilim\Tool\VD;

/**
 */
class array_allTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider data
     */
    function test(array $array, callable $callback, bool $expected)
    {
        $this->assertSame($expected, PF::array_all($array, $callback));
    }

    static function data(): array
    {
        $callable = function ($value): bool {
            return \strlen($value) > 2;
        };

        $callableKey = function ($value, $key): bool {
            return \is_numeric($key);
        };

        return [
            [[], $callable, true],
            [['a', 'aa', 'aaa', 'aaaa'], $callable, false],
            [['aaa', 'aaa'], $callable, true],
            [['a' => '1', 'b' => '12', 'c' => '123', 'd' => '1234'], $callable, false],
            [['a' => '1', 'b' => '12', 'c' => '123', 'd' => '1234'], $callableKey, false],
            [[1 => '1', 2 => '12', 3 => '123', 4 => '1234'], $callableKey, true],
        ];
    }
}
