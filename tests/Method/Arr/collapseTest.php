<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class collapseTest extends TestCase
{
    function test()
    {
        // Normal case: a two-dimensional array with different elements
        $data = [['foo', 'bar'], ['baz']];
        $this->assertEquals(['foo', 'bar', 'baz'], Arr::collapse($data));

        // Case including numeric and string elements
        $array = [[1], [2], [3], ['foo', 'bar']];
        $this->assertEquals([1, 2, 3, 'foo', 'bar'], Arr::collapse($array));

        // Case with empty two-dimensional arrays
        $emptyArray = [[], [], []];
        $this->assertEquals([], Arr::collapse($emptyArray));

        // Case with both empty arrays and arrays with elements
        $mixedArray = [[], [1, 2], [], ['foo', 'bar']];
        $this->assertEquals([1, 2, 'foo', 'bar'], Arr::collapse($mixedArray));

        // Case including collections and arrays
        // $collection = collect(['baz', 'boom']);
        $collection = new ClassArrayAccessIteratorAggregate(['baz', 'boom']);
        $mixedArray = [[1], [2], [3], ['foo', 'bar'], $collection];
        $this->assertEquals([1, 2, 3, 'foo', 'bar', 'baz', 'boom'], Arr::collapse($mixedArray));
    }
}
