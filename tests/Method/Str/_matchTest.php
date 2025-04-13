<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class _matchTest extends TestCase
{
    function test()
    {
        $this->assertSame('bar', Str::_match('/bar/', 'foo bar'));
        $this->assertSame('bar', Str::_match('/foo (.*)/', 'foo bar'));
        $this->assertEmpty(Str::_match('/nothing/', 'foo bar'));
        $this->assertEmpty(Str::_match('/pattern/', ''));
    }
}
