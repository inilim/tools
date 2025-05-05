<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class flattenTest extends TestCase
{
    function test()
    {
        // Flat arrays are unaffected
        $array = ['#foo', '#bar', '#baz'];
        $this->assertEquals(['#foo', '#bar', '#baz'], Arr::flatten($array));

        // Nested arrays are flattened with existing flat items
        $array = [['#foo', '#bar'], '#baz'];
        $this->assertEquals(['#foo', '#bar', '#baz'], Arr::flatten($array));

        // Flattened array includes "null" items
        $array = [['#foo', null], '#baz', null];
        $this->assertEquals(['#foo', null, '#baz', null], Arr::flatten($array));

        // Sets of nested arrays are flattened
        $array = [['#foo', '#bar'], ['#baz']];
        $this->assertEquals(['#foo', '#bar', '#baz'], Arr::flatten($array));

        // Deeply nested arrays are flattened
        $array = [['#foo', ['#bar']], ['#baz']];
        $this->assertEquals(['#foo', '#bar', '#baz'], Arr::flatten($array));

        // Nested arrays are flattened alongside arrays
        $array = [new ClassArrayAccessIteratorAggregate(['#foo', '#bar']), ['#baz']];
        $this->assertEquals(['#foo', '#bar', '#baz'], Arr::flatten($array));

        // Nested arrays containing plain arrays are flattened
        $array = [new ClassArrayAccessIteratorAggregate(['#foo', ['#bar']]), ['#baz']];
        $this->assertEquals(['#foo', '#bar', '#baz'], Arr::flatten($array));

        // Nested arrays containing arrays are flattened
        $array = [['#foo', new ClassArrayAccessIteratorAggregate(['#bar'])], ['#baz']];
        $this->assertEquals(['#foo', '#bar', '#baz'], Arr::flatten($array));

        // Nested arrays containing arrays containing arrays are flattened
        $array = [['#foo', new ClassArrayAccessIteratorAggregate(['#bar', ['#zap']])], ['#baz']];
        $this->assertEquals(['#foo', '#bar', '#zap', '#baz'], Arr::flatten($array));
    }

    function testFlattenWithDepth()
    {
        // No depth flattens recursively
        $array = [['#foo', ['#bar', ['#baz']]], '#zap'];
        $this->assertEquals(['#foo', '#bar', '#baz', '#zap'], Arr::flatten($array));

        // Specifying a depth only flattens to that depth
        $array = [['#foo', ['#bar', ['#baz']]], '#zap'];
        $this->assertEquals(['#foo', ['#bar', ['#baz']], '#zap'], Arr::flatten($array, 1));

        $array = [['#foo', ['#bar', ['#baz']]], '#zap'];
        $this->assertEquals(['#foo', '#bar', ['#baz'], '#zap'], Arr::flatten($array, 2));
    }
}
