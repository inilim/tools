<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class isListTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Arr::isList([]));
        $this->assertTrue(Arr::isList([1, 2, 3]));
        $this->assertTrue(Arr::isList(['foo', 2, 3]));
        $this->assertTrue(Arr::isList(['foo', 'bar']));
        $this->assertTrue(Arr::isList([0 => 'foo', 'bar']));
        $this->assertTrue(Arr::isList([0 => 'foo', 1 => 'bar']));

        $this->assertFalse(Arr::isList([-1 => 1]));
        $this->assertFalse(Arr::isList([-1 => 1, 0 => 2]));
        $this->assertFalse(Arr::isList([1 => 'foo', 'bar']));
        $this->assertFalse(Arr::isList([1 => 'foo', 0 => 'bar']));
        $this->assertFalse(Arr::isList([0 => 'foo', 'bar' => 'baz']));
        $this->assertFalse(Arr::isList([0 => 'foo', 2 => 'bar']));
        $this->assertFalse(Arr::isList(['foo' => 'bar', 'baz' => 'qux']));
    }
}
