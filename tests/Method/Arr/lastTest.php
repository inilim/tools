<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class lastTest extends TestCase
{
    function test()
    {
        $array = [100, 200, 300];

        // Callback is null and array is empty
        $this->assertNull(Arr::last([], null));
        $this->assertSame('foo', Arr::last([], null, 'foo'));
        $this->assertSame('bar', Arr::last([], null, function () {
            return 'bar';
        }));

        // Callback is null and array is not empty
        $this->assertEquals(300, Arr::last($array));

        // Callback is not null and array is not empty
        $value = Arr::last($array, function ($value) {
            return $value < 250;
        });
        $this->assertEquals(200, $value);

        // Callback is not null, array is not empty but no satisfied item
        $value2 = Arr::last($array, function ($value) {
            return $value > 300;
        });
        $value3 = Arr::last($array, function ($value) {
            return $value > 300;
        }, 'bar');
        $value4 = Arr::last($array, function ($value) {
            return $value > 300;
        }, function () {
            return 'baz';
        });
        $value5 = Arr::last($array, function ($value, $key) {
            return $key < 2;
        });
        $this->assertNull($value2);
        $this->assertSame('bar', $value3);
        $this->assertSame('baz', $value4);
        $this->assertEquals(200, $value5);
    }
}
