<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use Inilim\Tool\VD;

/**
 */
class array_find_keyTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider data
     */
    function test(array $array, callable $callback, $expected)
    {
        $this->assertSame($expected, PF::array_find_key($array, $callback));
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
            [[], $callable, null],
            [['a', 'aa', 'aaa', 'aaaa'], $callable, 2],
            [['a', 'aa'], $callable, null],
            [['a' => '1', 'b' => '12', 'c' => '123', 'd' => '1234'], $callable, 'c'],
            [['a' => '1', 'b' => '12', 'c' => '123', 3 => '1234'], $callableKey, 3],
        ];
    }
}
