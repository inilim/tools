<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class wordsTest extends TestCase
{
    function testStringCanBeLimitedByWords()
    {
        $this->assertSame('Hello...', Str::words('Hello World', 1));
        $this->assertSame('Hello___', Str::words('Hello World', 1, '___'));
        $this->assertSame('Hello World', Str::words('Hello World', 3));
        $this->assertSame('Hello World', Str::words('Hello World', -1, '...'));
        $this->assertSame('', Str::words('', 3, '...'));
    }

    function testStringCanBeLimitedByWordsNonAscii()
    {
        $this->assertSame('这是...', Str::words('这是 段中文', 1));
        $this->assertSame('这是___', Str::words('这是 段中文', 1, '___'));
        $this->assertSame('这是-段中文', Str::words('这是-段中文', 3, '___'));
        $this->assertSame('这是___', Str::words('这是     段中文', 1, '___'));
    }

    function testStringTrimmedOnlyWhereNecessary()
    {
        $this->assertSame(' Hello World ', Str::words(' Hello World ', 3));
        $this->assertSame(' Hello...', Str::words(' Hello World ', 1));
    }

    function testStringWithoutWordsDoesntProduceError()
    {
        $nbsp = chr(0xC2) . chr(0xA0);
        $this->assertSame(' ', Str::words(' '));
        $this->assertEquals($nbsp, Str::words($nbsp));
        $this->assertSame('   ', Str::words('   '));
        $this->assertSame("\t\t\t", Str::words("\t\t\t"));
    }
}
