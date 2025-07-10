<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class joinTest extends TestCase
{
    function test()
    {
        $this->assertSame('a,b,c', Arr::join(['a', 'b', 'c']));

        $this->assertSame('a, b, c', Arr::join(['a', 'b', 'c'], ', '));

        $this->assertSame('a, b and c', Arr::join(['a', 'b', 'c'], ', ', ' and '));

        $this->assertSame('a and b', Arr::join(['a', 'b'], ', ', ' and '));

        $this->assertSame('a', Arr::join(['a'], ', ', ' and '));

        $this->assertSame('', Arr::join([], ', ', ' and '));
    }
}
