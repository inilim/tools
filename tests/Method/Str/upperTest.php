<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class upperTest extends TestCase
{
    function test()
    {
        $this->assertSame('FOO BAR BAZ', Str::upper('foo bar baz'));
        $this->assertSame('FOO BAR BAZ', Str::upper('foO bAr BaZ'));
        $this->assertSame('ПРИВЕТ МИР', Str::upper('прИвеТ мИр'));
    }
}
