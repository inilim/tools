<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class soleTest extends TestCase
{
    function testSoleReturnsFirstItemInCollectionIfOnlyOneExists()
    {
        $this->assertSame('foo', Arr::sole(['foo']));

        $array = [
            ['name' => 'foo'],
            ['name' => 'bar'],
        ];

        $this->assertSame(
            ['name' => 'foo'],
            Arr::sole($array, fn(array $value) => $value['name'] === 'foo')
        );
    }

    function testSoleThrowsExceptionIfNoItemsExist()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Item not found');

        Arr::sole(['foo'], fn(string $value) => $value === 'baz');
    }

    function testSoleThrowsExceptionIfMoreThanOneItemExists()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Multiple items found: 2');

        Arr::sole(['baz', 'foo', 'baz'], fn(string $value) => $value === 'baz');
    }
}
