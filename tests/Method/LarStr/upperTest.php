<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class upperTest extends TestCase
{
    function test()
    {
        $this->assertSame('FOO BAR BAZ', LarStr::upper('foo bar baz'));
        $this->assertSame('FOO BAR BAZ', LarStr::upper('foO bAr BaZ'));
        $this->assertSame('ПРИВЕТ МИР', LarStr::upper('прИвеТ мИр'));
    }
}
