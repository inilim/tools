<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;

class wrapTest extends TestCase
{
    public function testWrap()
    {
        $string = 'a';
        $array = ['a'];
        $object = new \stdClass;
        $object->value = 'a';
        $this->assertEquals(['a'], LarArr::wrap($string));
        $this->assertEquals($array, LarArr::wrap($array));
        $this->assertEquals([$object], LarArr::wrap($object));
        $this->assertEquals([], LarArr::wrap(null));
        $this->assertEquals([null], LarArr::wrap([null]));
        $this->assertEquals([null, null], LarArr::wrap([null, null]));
        $this->assertEquals([''], LarArr::wrap(''));
        $this->assertEquals([''], LarArr::wrap(['']));
        $this->assertEquals([false], LarArr::wrap(false));
        $this->assertEquals([false], LarArr::wrap([false]));
        $this->assertEquals([0], LarArr::wrap(0));

        $obj = new \stdClass;
        $obj->value = 'a';
        $obj = \unserialize(\serialize($obj));
        $this->assertEquals([$obj], LarArr::wrap($obj));
        $this->assertSame($obj, LarArr::wrap($obj)[0]);
    }
}
