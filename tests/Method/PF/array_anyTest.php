<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use Inilim\Tool\VD;

/**
 */
class array_anyTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider data
     */
    function test(array $array, callable $callback, bool $expected)
    {
        $this->assertSame($expected, PF::array_any($array, $callback));
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
            [[], $callable, false],
            [['a', 'aa', 'aaa', 'aaaa'], $callable, true],
            [['a', 'aa'], $callable, false],
            [['a' => '1', 'b' => '12', 'c' => '123', 'd' => '1234'], $callable, true],
            [['a' => '1', 'b' => '12', 'c' => '123', 3 => '1234'], $callableKey, true],
            [['a' => '1', 'b' => '12', 'c' => '123', 'd' => '1234'], $callableKey, false],
        ];
    }
}
