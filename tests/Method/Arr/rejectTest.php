<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class rejectTest extends TestCase
{
    function test()
    {
        $array = [1, 2, 3, 4, 5, 6];

        // Test rejection behavior (removing even numbers)
        $result = Arr::reject($array, function ($value) {
            return $value % 2 === 0;
        });

        $this->assertEquals([
            0 => 1,
            2 => 3,
            4 => 5,
        ], $result);

        // Test key preservation with associative array
        $assocArray = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];

        $result = Arr::reject($assocArray, function ($value) {
            return $value > 2;
        });

        $this->assertEquals([
            'a' => 1,
            'b' => 2,
        ], $result);
    }
}
