<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class takeTest extends TestCase
{
    function test()
    {
        $array = [1, 2, 3, 4, 5, 6];

        // Test with a positive limit, should return the first 'limit' elements.
        $this->assertEquals([1, 2, 3], Arr::take($array, 3));

        // Test with a negative limit, should return the last 'abs(limit)' elements.
        $this->assertEquals([4, 5, 6], Arr::take($array, -3));

        // Test with zero limit, should return an empty array.
        $this->assertEquals([], Arr::take($array, 0));

        // Test with a limit greater than the array size, should return the entire array.
        $this->assertEquals([1, 2, 3, 4, 5, 6], Arr::take($array, 10));

        // Test with a negative limit greater than the array size, should return the entire array.
        $this->assertEquals([1, 2, 3, 4, 5, 6], Arr::take($array, -10));
    }
}
