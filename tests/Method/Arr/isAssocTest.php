<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class isAssocTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Arr::isAssoc(['a' => 'a', 0 => 'b']));
        $this->assertTrue(Arr::isAssoc([1 => 'a', 0 => 'b']));
        $this->assertTrue(Arr::isAssoc([1 => 'a', 2 => 'b']));
        $this->assertFalse(Arr::isAssoc([0 => 'a', 1 => 'b']));
        $this->assertFalse(Arr::isAssoc(['a', 'b']));

        $this->assertFalse(Arr::isAssoc([]));
        $this->assertFalse(Arr::isAssoc([1, 2, 3]));
        $this->assertFalse(Arr::isAssoc(['foo', 2, 3]));
        $this->assertFalse(Arr::isAssoc([0 => 'foo', 'bar']));

        $this->assertTrue(Arr::isAssoc([1 => 'foo', 'bar']));
        $this->assertTrue(Arr::isAssoc([0 => 'foo', 'bar' => 'baz']));
        $this->assertTrue(Arr::isAssoc([0 => 'foo', 2 => 'bar']));
        $this->assertTrue(Arr::isAssoc(['foo' => 'bar', 'baz' => 'qux']));
    }
}
