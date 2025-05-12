<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\TestToJsonObject;
use Inilim\Tool\Test\ForTest\TestToArrayObject;
use Inilim\Tool\Test\ForTest\TestJsonSerializeObject;
use Inilim\Tool\Test\ForTest\TestTraversableAndJsonSerializableObject;

class arrayableTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Arr::arrayable([]));
        $this->assertTrue(Arr::arrayable(new TestToArrayObject));
        $this->assertTrue(Arr::arrayable(new TestToJsonObject));
        $this->assertTrue(Arr::arrayable(new TestJsonSerializeObject));
        $this->assertTrue(Arr::arrayable(new TestTraversableAndJsonSerializableObject));

        $this->assertFalse(Arr::arrayable(null));
        $this->assertFalse(Arr::arrayable('abc'));
        $this->assertFalse(Arr::arrayable(new \stdClass));
        $this->assertFalse(Arr::arrayable((object) ['a' => 1, 'b' => 2]));
        $this->assertFalse(Arr::arrayable(123));
        $this->assertFalse(Arr::arrayable(12.34));
        $this->assertFalse(Arr::arrayable(true));
        $this->assertFalse(Arr::arrayable(new \DateTime));
        $this->assertFalse(Arr::arrayable(static fn() => null));
    }
}
