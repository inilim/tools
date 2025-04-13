<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class replaceStart extends TestCase
{
    function test()
    {
        $this->assertSame('foobar foobar', Str::replaceStart('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/bar? foo/bar?', Str::replaceStart('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('quxbar foobar', Str::replaceStart('foo', 'qux', 'foobar foobar'));
        $this->assertSame('qux? foo/bar?', Str::replaceStart('foo/bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('bar foobar', Str::replaceStart('foo', '', 'foobar foobar'));
        $this->assertSame('1', Str::replaceStart('0', '1', '0'));
        // Test for multibyte string support
        $this->assertSame('xxxnköping Malmö', Str::replaceStart('Jö', 'xxx', 'Jönköping Malmö'));
        $this->assertSame('Jönköping Malmö', Str::replaceStart('', 'yyy', 'Jönköping Malmö'));
    }
}
