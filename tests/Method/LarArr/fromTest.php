<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\TestToJsonObject;
use Inilim\Tool\Test\ForTest\TestToArrayObject;
use Inilim\Tool\Test\ForTest\TestJsonSerializeObject;
use Inilim\Tool\Test\ForTest\TestJsonSerializeWithScalarValueObject;
use Inilim\Tool\Test\ForTest\TestTraversableAndJsonSerializableObject;

class fromTest extends TestCase
{
    public function testFrom()
    {
        $this->assertSame(['foo' => 'bar'], LarArr::from(['foo' => 'bar']));
        $this->assertSame(['foo' => 'bar'], LarArr::from((object) ['foo' => 'bar']));
        $this->assertSame(['foo' => 'bar'], LarArr::from(new TestToArrayObject));
        $this->assertSame(['foo' => 'bar'], LarArr::from(new TestToJsonObject));
        $this->assertSame(['foo' => 'bar'], LarArr::from(new TestJsonSerializeObject));
        $this->assertSame(['foo'], LarArr::from(new TestJsonSerializeWithScalarValueObject));

        $subject = [new \stdClass, new \stdClass];
        $items = new TestTraversableAndJsonSerializableObject($subject);
        $this->assertSame($subject, LarArr::from($items));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Items cannot be represented by a scalar value.');
        LarArr::from(123);
    }
}
