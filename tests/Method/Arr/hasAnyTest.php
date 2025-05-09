<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class hasAnyTest extends TestCase
{
    function test()
    {
        $array = ['name' => 'Taylor', 'age' => '', 'city' => null];
        $this->assertTrue(Arr::hasAny($array, 'name'));
        $this->assertTrue(Arr::hasAny($array, 'age'));
        $this->assertTrue(Arr::hasAny($array, 'city'));
        $this->assertFalse(Arr::hasAny($array, 'foo'));
        $this->assertTrue(Arr::hasAny($array, 'name', 'email'));
        $this->assertTrue(Arr::hasAny($array, ['name', 'email']));

        $array = ['name' => 'Taylor', 'email' => 'foo'];
        $this->assertTrue(Arr::hasAny($array, 'name', 'email'));
        $this->assertFalse(Arr::hasAny($array, 'surname', 'password'));
        $this->assertFalse(Arr::hasAny($array, ['surname', 'password']));

        $array = ['foo' => ['bar' => null, 'baz' => '']];
        $this->assertTrue(Arr::hasAny($array, 'foo.bar'));
        $this->assertTrue(Arr::hasAny($array, 'foo.baz'));
        $this->assertFalse(Arr::hasAny($array, 'foo.bax'));
        $this->assertTrue(Arr::hasAny($array, ['foo.bax', 'foo.baz']));
    }
}
