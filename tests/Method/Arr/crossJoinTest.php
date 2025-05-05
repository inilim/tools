<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class crossJoinTest extends TestCase
{
    function test()
    {
        // Single dimension
        $this->assertSame(
            [[1, 'a'], [1, 'b'], [1, 'c']],
            Arr::crossJoin([1], ['a', 'b', 'c'])
        );

        // Square matrix
        $this->assertSame(
            [[1, 'a'], [1, 'b'], [2, 'a'], [2, 'b']],
            Arr::crossJoin([1, 2], ['a', 'b'])
        );

        // Rectangular matrix
        $this->assertSame(
            [[1, 'a'], [1, 'b'], [1, 'c'], [2, 'a'], [2, 'b'], [2, 'c']],
            Arr::crossJoin([1, 2], ['a', 'b', 'c'])
        );

        // 3D matrix
        $this->assertSame(
            [
                [1, 'a', 'I'],
                [1, 'a', 'II'],
                [1, 'a', 'III'],
                [1, 'b', 'I'],
                [1, 'b', 'II'],
                [1, 'b', 'III'],
                [2, 'a', 'I'],
                [2, 'a', 'II'],
                [2, 'a', 'III'],
                [2, 'b', 'I'],
                [2, 'b', 'II'],
                [2, 'b', 'III'],
            ],
            Arr::crossJoin([1, 2], ['a', 'b'], ['I', 'II', 'III'])
        );

        // With 1 empty dimension
        $this->assertEmpty(Arr::crossJoin([], ['a', 'b'], ['I', 'II', 'III']));
        $this->assertEmpty(Arr::crossJoin([1, 2], [], ['I', 'II', 'III']));
        $this->assertEmpty(Arr::crossJoin([1, 2], ['a', 'b'], []));

        // With empty arrays
        $this->assertEmpty(Arr::crossJoin([], [], []));
        $this->assertEmpty(Arr::crossJoin([], []));
        $this->assertEmpty(Arr::crossJoin([]));

        // Not really a proper usage, still, test for preserving BC
        $this->assertSame([[]], Arr::crossJoin());
    }
}
