<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\TestEnum;
use Inilim\Tool\Test\ForTest\TestBackedEnum;
use Inilim\Tool\Test\ForTest\TestToJsonObject;
use Inilim\Tool\Test\ForTest\TestToArrayObject;
use Inilim\Tool\Test\ForTest\TestStringBackedEnum;
use Inilim\Tool\Test\ForTest\TestJsonSerializeObject;
use Inilim\Tool\Test\ForTest\TestJsonSerializeWithScalarValueObject;
use Inilim\Tool\Test\ForTest\TestTraversableAndJsonSerializableObject;

class fromTest extends TestCase
{
    function test()
    {
        $this->assertSame(['foo' => 'bar'], Arr::from(['foo' => 'bar']));
        $this->assertSame(['foo' => 'bar'], Arr::from((object) ['foo' => 'bar']));
        $this->assertSame(['foo' => 'bar'], Arr::from(new TestToArrayObject));
        $this->assertSame(['foo' => 'bar'], Arr::from(new TestToJsonObject));
        $this->assertSame(['foo' => 'bar'], Arr::from(new TestJsonSerializeObject));
        $this->assertSame(['foo'], Arr::from(new TestJsonSerializeWithScalarValueObject));

        if (PHP_VERSION >= 80000) {
            $items = new \WeakMap;
            $items[$temp = new class {}] = 'bar';
            $this->assertSame(['bar'], Arr::from($items));
        }
        if (PHP_VERSION >= 80100) {
            $this->assertSame(['name' => 'A'], Arr::from(TestEnum::A));
            $this->assertSame(['name' => 'A', 'value' => 1], Arr::from(TestBackedEnum::A));
            $this->assertSame(['name' => 'A', 'value' => 'A'], Arr::from(TestStringBackedEnum::A));
        }

        $subject = [new \stdClass, new \stdClass];
        $items = new TestTraversableAndJsonSerializableObject($subject);
        $this->assertSame($subject, Arr::from($items));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Items cannot be represented by a scalar value.');
        Arr::from(123);
    }
}
