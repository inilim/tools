<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class replaceLast extends TestCase
{
    function test()
    {
        $this->assertSame('foobar fooqux', Str::replaceLast('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/bar? foo/qux?', Str::replaceLast('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('foobar foo', Str::replaceLast('bar', '', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceLast('xxx', 'yyy', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceLast('', 'yyy', 'foobar foobar'));
        // Test for multibyte string support
        $this->assertSame('Malmö Jönkxxxping', Str::replaceLast('ö', 'xxx', 'Malmö Jönköping'));
        $this->assertSame('Malmö Jönköping', Str::replaceLast('', 'yyy', 'Malmö Jönköping'));
    }
}
