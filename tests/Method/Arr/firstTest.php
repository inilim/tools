<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class firstTest extends TestCase
{
    function test()
    {
        $array = [100, 200, 300];

        // Callback is null and array is empty
        $this->assertNull(Arr::first([], null));
        $this->assertSame('foo', Arr::first([], null, 'foo'));
        $this->assertSame('bar', Arr::first([], null, function () {
            return 'bar';
        }));

        // Callback is null and array is not empty
        $this->assertEquals(100, Arr::first($array));

        // Callback is not null and array is not empty
        $value = Arr::first($array, function ($value) {
            return $value >= 150;
        });
        $this->assertEquals(200, $value);

        // Callback is not null, array is not empty but no satisfied item
        $value2 = Arr::first($array, function ($value) {
            return $value > 300;
        });
        $value3 = Arr::first($array, function ($value) {
            return $value > 300;
        }, 'bar');
        $value4 = Arr::first($array, function ($value) {
            return $value > 300;
        }, function () {
            return 'baz';
        });
        $value5 = Arr::first($array, function ($value, $key) {
            return $key < 2;
        });
        $this->assertNull($value2);
        $this->assertSame('bar', $value3);
        $this->assertSame('baz', $value4);
        $this->assertEquals(100, $value5);

        $cursor = (function () {
            while (false) {
                yield 1;
            }
        })();
        $this->assertNull(Arr::first($cursor));
    }
}
