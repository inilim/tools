<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class repeatTest extends TestCase
{
    function test()
    {
        $this->assertSame('', Str::repeat('Hello', 0));
        $this->assertSame('Hello', Str::repeat('Hello', 1));
        $this->assertSame('aaaaa', Str::repeat('a', 5));
        $this->assertSame('', Str::repeat('', 5));
    }

    function testRepeatWhenTimesIsNegative()
    {
        $this->expectException(\Exception::class);
        Str::repeat('Hello', -2);
    }
}
