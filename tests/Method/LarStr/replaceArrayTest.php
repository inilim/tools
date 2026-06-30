<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class replaceArrayTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo/bar/baz', LarStr::replaceArray('?', ['foo', 'bar', 'baz'], '?/?/?'));
        $this->assertSame('foo/bar/baz/?', LarStr::replaceArray('?', ['foo', 'bar', 'baz'], '?/?/?/?'));
        $this->assertSame('foo/bar', LarStr::replaceArray('?', ['foo', 'bar', 'baz'], '?/?'));
        $this->assertSame('?/?/?', LarStr::replaceArray('x', ['foo', 'bar', 'baz'], '?/?/?'));
        // Ensure recursive replacements are avoided
        $this->assertSame('foo?/bar/baz', LarStr::replaceArray('?', ['foo?', 'bar', 'baz'], '?/?/?'));
        // Test for associative array support
        $this->assertSame('foo/bar', LarStr::replaceArray('?', [1 => 'foo', 2 => 'bar'], '?/?'));
        $this->assertSame('foo/bar', LarStr::replaceArray('?', ['x' => 'foo', 'y' => 'bar'], '?/?'));
        // Test does not crash on bad input
        $this->assertSame('?', LarStr::replaceArray('?', [(object) ['foo' => 'bar']], '?'));
    }
}
