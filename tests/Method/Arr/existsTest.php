<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class existsTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Arr::exists([1], 0));
        $this->assertTrue(Arr::exists([null], 0));
        $this->assertTrue(Arr::exists(['a' => 1], 'a'));
        $this->assertTrue(Arr::exists(['a' => null], 'a'));
        $this->assertTrue(Arr::exists(new ClassArrayAccessIteratorAggregate(['a' => null]), 'a'));

        $this->assertFalse(Arr::exists([1], 1));
        $this->assertFalse(Arr::exists([null], 1));
        $this->assertFalse(Arr::exists(['a' => 1], 0));
        $this->assertFalse(Arr::exists(new ClassArrayAccessIteratorAggregate(['a' => null]), 'b'));
    }
}
