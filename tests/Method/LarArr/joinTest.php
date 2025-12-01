<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;

class joinTest extends TestCase
{
    public function testJoin()
    {
        $this->assertSame('a, b, c', LarArr::join(['a', 'b', 'c'], ', '));

        $this->assertSame('a, b and c', LarArr::join(['a', 'b', 'c'], ', ', ' and '));

        $this->assertSame('a and b', LarArr::join(['a', 'b'], ', ', ' and '));

        $this->assertSame('a', LarArr::join(['a'], ', ', ' and '));

        $this->assertSame('', LarArr::join([], ', ', ' and '));
    }
}

