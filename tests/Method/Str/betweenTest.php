<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class betweenTest extends TestCase
{
    function test()
    {
        $this->assertSame('abc', Str::between('abc', '', 'c'));
        $this->assertSame('abc', Str::between('abc', 'a', ''));
        $this->assertSame('abc', Str::between('abc', '', ''));
        $this->assertSame('b', Str::between('abc', 'a', 'c'));
        $this->assertSame('b', Str::between('dddabc', 'a', 'c'));
        $this->assertSame('b', Str::between('abcddd', 'a', 'c'));
        $this->assertSame('b', Str::between('dddabcddd', 'a', 'c'));
        $this->assertSame('nn', Str::between('hannah', 'ha', 'ah'));
        $this->assertSame('a]ab[b', Str::between('[a]ab[b]', '[', ']'));
        $this->assertSame('foo', Str::between('foofoobar', 'foo', 'bar'));
        $this->assertSame('bar', Str::between('foobarbar', 'foo', 'bar'));
        $this->assertSame('234', Str::between('12345', 1, 5));
        $this->assertSame('45', Str::between('123456789', '123', '6789'));
        $this->assertSame('nothing', Str::between('nothing', 'foo', 'bar'));
    }
}
