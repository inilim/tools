<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class whereTest extends TestCase
{
    function test()
    {
        $array = [100, '200', 300, '400', 500];

        $array = Arr::where($array, function ($value, $key) {
            return is_string($value);
        });

        $this->assertEquals([1 => '200', 3 => '400'], $array);
    }

    function testWhereKey()
    {
        $array = ['10' => 1, 'foo' => 3, 20 => 2];

        $array = Arr::where($array, function ($value, $key) {
            return is_numeric($key);
        });

        $this->assertEquals(['10' => 1, 20 => 2], $array);
    }
}
