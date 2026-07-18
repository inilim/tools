<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\TestToJsonObject;
use Inilim\Tool\Test\ForTest\TestToArrayObject;
use Inilim\Tool\Test\ForTest\TestJsonSerializeObject;
use Inilim\Tool\Test\ForTest\TestTraversableAndJsonSerializableObject;

class arrayableTest extends TestCase
{
    public function testArrayable(): void
    {
        $this->assertTrue(LarArr::arrayable([]));
        $this->assertTrue(LarArr::arrayable(new TestToArrayObject));
        $this->assertTrue(LarArr::arrayable(new TestToJsonObject));
        $this->assertTrue(LarArr::arrayable(new TestJsonSerializeObject));
        $this->assertTrue(LarArr::arrayable(new TestTraversableAndJsonSerializableObject));

        $this->assertFalse(LarArr::arrayable(null));
        $this->assertFalse(LarArr::arrayable('abc'));
        $this->assertFalse(LarArr::arrayable(new \stdClass));
        $this->assertFalse(LarArr::arrayable((object) ['a' => 1, 'b' => 2]));
        $this->assertFalse(LarArr::arrayable(123));
        $this->assertFalse(LarArr::arrayable(12.34));
        $this->assertFalse(LarArr::arrayable(true));
        $this->assertFalse(LarArr::arrayable(new \DateTime));
        $this->assertFalse(LarArr::arrayable(static fn() => null));
    }
}
