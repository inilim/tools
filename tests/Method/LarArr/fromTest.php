<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\TestProcess;
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

    function testWeakMap()
    {
        $dir = CasePhpT::self()->getDir([LarArr::class, 'from']);
        $case = $dir . '/WeakMap.php';
        foreach (['8.0', '8.1', '8.2', '8.3', '8.4'] as $php) {
            $asserts = (new TestProcess($case))->withPhp($php)->run();
            foreach ($asserts as $assert) {
                $this->assertTag($assert);
            }
        }
    }

    function testEnum()
    {
        $dir = CasePhpT::self()->getDir([LarArr::class, 'from']);
        $case = $dir . '/enum.php';
        foreach (['8.1', '8.2', '8.3', '8.4'] as $php) {
            $asserts = (new TestProcess($case))->withPhp($php)->run();
            foreach ($asserts as $assert) {
                $this->assertTag($assert);
            }
        }
    }
}
