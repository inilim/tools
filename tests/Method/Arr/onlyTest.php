<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class onlyTest extends TestCase
{
    function test()
    {
        $array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];
        $array = Arr::only($array, ['name', 'price']);
        $this->assertEquals(['name' => 'Desk', 'price' => 100], $array);
        $this->assertEmpty(Arr::only($array, ['nonExistingKey']));

        $this->assertEmpty(Arr::only($array, null));

        // Test with array having numeric keys
        $this->assertEquals(['foo'], Arr::only(['foo', 'bar', 'baz'], 0));
        $this->assertEquals([1 => 'bar', 2 => 'baz'], Arr::only(['foo', 'bar', 'baz'], [1, 2]));
        $this->assertEmpty(Arr::only(['foo', 'bar', 'baz'], [3]));

        // Test with array having numeric key and string key
        $this->assertEquals(['foo'], Arr::only(['foo', 'bar' => 'baz'], 0));
        $this->assertEquals(['bar' => 'baz'], Arr::only(['foo', 'bar' => 'baz'], 'bar'));
    }
}
