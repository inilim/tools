<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class betweenFirst extends TestCase
{
    function test()
    {
        $this->assertSame('abc', Str::betweenFirst('abc', '', 'c'));
        $this->assertSame('abc', Str::betweenFirst('abc', 'a', ''));
        $this->assertSame('abc', Str::betweenFirst('abc', '', ''));
        $this->assertSame('b', Str::betweenFirst('abc', 'a', 'c'));
        $this->assertSame('b', Str::betweenFirst('dddabc', 'a', 'c'));
        $this->assertSame('b', Str::betweenFirst('abcddd', 'a', 'c'));
        $this->assertSame('b', Str::betweenFirst('dddabcddd', 'a', 'c'));
        $this->assertSame('nn', Str::betweenFirst('hannah', 'ha', 'ah'));
        $this->assertSame('a', Str::betweenFirst('[a]ab[b]', '[', ']'));
        $this->assertSame('foo', Str::betweenFirst('foofoobar', 'foo', 'bar'));
        $this->assertSame('', Str::betweenFirst('foobarbar', 'foo', 'bar'));
    }
}
