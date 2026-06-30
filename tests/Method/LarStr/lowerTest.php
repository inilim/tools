<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class lowerTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo bar baz', LarStr::lower('FOO BAR BAZ'));
        $this->assertSame('foo bar baz', LarStr::lower('fOo Bar bAz'));
        $this->assertSame('привет мир', LarStr::lower('ПриВет МиР'));
    }
}
