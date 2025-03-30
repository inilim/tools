<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class wrapTest extends TestCase
{
    function test()
    {
        $string = 'a';
        $array = ['a'];
        $object = new \stdClass;
        $object->value = 'a';
        $this->assertEquals(['a'], Arr::wrap($string));
        $this->assertEquals($array, Arr::wrap($array));
        $this->assertEquals([$object], Arr::wrap($object));
        $this->assertEquals([null], Arr::wrap(null));
        $this->assertEquals([null], Arr::wrap([null]));
        $this->assertEquals([null, null], Arr::wrap([null, null]));
        $this->assertEquals([''], Arr::wrap(''));
        $this->assertEquals([''], Arr::wrap(['']));
        $this->assertEquals([false], Arr::wrap(false));
        $this->assertEquals([false], Arr::wrap([false]));
        $this->assertEquals([0], Arr::wrap(0));

        $obj = new \stdClass;
        $obj->value = 'a';
        $obj = \unserialize(\serialize($obj));
        $this->assertEquals([$obj], Arr::wrap($obj));
        $this->assertSame($obj, Arr::wrap($obj)[0]);
    }
}
