<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class whereNotNullTest extends TestCase
{
    function test()
    {
        $array = array_values(Arr::whereNotNull([null, 0, false, '', null, []]));
        $this->assertEquals([0, false, '', []], $array);

        $array = array_values(Arr::whereNotNull([1, 2, 3]));
        $this->assertEquals([1, 2, 3], $array);

        $array = array_values(Arr::whereNotNull([null, null, null]));
        $this->assertEquals([], $array);

        $array = array_values(Arr::whereNotNull(['a', null, 'b', null, 'c']));
        $this->assertEquals(['a', 'b', 'c'], $array);

        $array = array_values(Arr::whereNotNull([null, 1, 'string', 0.0, false, [], new \stdClass(), fn() => null]));
        $this->assertEquals([1, 'string', 0.0, false, [], new \stdClass(), fn() => null], $array);
    }
}
