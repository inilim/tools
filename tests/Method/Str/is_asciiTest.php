<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class is_asciiTest extends TestCase
{
    function testUtf8()
    {
        $str = 'testiñg';
        static::assertFalse(Str::is_ascii($str));
    }

    function testAscii()
    {
        $str = 'testing';
        static::assertTrue(Str::is_ascii($str));
    }

    function testInvalidChar()
    {
        $str = "tes\xe9ting";
        static::assertFalse(Str::is_ascii($str));
    }

    function testEmptyStr()
    {
        $str = '';
        static::assertTrue(Str::is_ascii($str));
    }

    function testNewLine()
    {
        $str = "a\nb\nc";
        static::assertTrue(Str::is_ascii($str));
    }

    function testTab()
    {
        $str = "a\tb\tc";
        static::assertTrue(Str::is_ascii($str));
    }
}
