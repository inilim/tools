<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class onlyOrFailTest extends TestCase
{
    function test()
    {
        $array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];
        $array = Arr::onlyOrFail($array, ['name', 'price']);
        $this->assertEquals(['name' => 'Desk', 'price' => 100], $array);

        // Test with array having numeric keys
        $this->assertEquals(['foo'], Arr::onlyOrFail(['foo', 'bar', 'baz'], 0));
        $this->assertEquals([1 => 'bar', 2 => 'baz'], Arr::onlyOrFail(['foo', 'bar', 'baz'], [1, 2]));

        // Test with array having numeric key and string key
        $this->assertEquals(['foo'], Arr::onlyOrFail(['foo', 'bar' => 'baz'], 0));
        $this->assertEquals(['bar' => 'baz'], Arr::onlyOrFail(['foo', 'bar' => 'baz'], 'bar'));
    }

    function test_exp_1()
    {
        $this->expectException(\Exception::class);
        Arr::onlyOrFail(['foo', 'bar', 'baz'], [3]);
    }

    function test_exp_2()
    {
        $this->expectException(\Exception::class);
        $array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];
        Arr::onlyOrFail($array, ['nonExistingKey']);
    }
}
