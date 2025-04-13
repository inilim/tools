<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class replaceFirstTest extends TestCase
{
    function test()
    {
        $this->assertSame('fooqux foobar', Str::replaceFirst('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/qux? foo/bar?', Str::replaceFirst('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('foo foobar', Str::replaceFirst('bar', '', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceFirst('xxx', 'yyy', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceFirst('', 'yyy', 'foobar foobar'));
        $this->assertSame('1', Str::replaceFirst('0', '1', '0'));
        // Test for multibyte string support
        $this->assertSame('Jxxxnköping Malmö', Str::replaceFirst('ö', 'xxx', 'Jönköping Malmö'));
        $this->assertSame('Jönköping Malmö', Str::replaceFirst('', 'yyy', 'Jönköping Malmö'));
    }
}
