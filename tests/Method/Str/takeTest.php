<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class takeTest extends TestCase
{
    function test()
    {
        $this->assertSame('ab', Str::take('abcdef', 2));
        $this->assertSame('ef', Str::take('abcdef', -2));
        $this->assertSame('', Str::take('abcdef', 0));
        $this->assertSame('', Str::take('', 2));
        $this->assertSame('abcdef', Str::take('abcdef', 10));
        $this->assertSame('abcdef', Str::take('abcdef', 6));
        $this->assertSame('ü', Str::take('üöä', 1));
    }
}
