<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class replaceTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo bar laravel', LarStr::replace('baz', 'laravel', 'foo bar baz'));
        $this->assertSame('foo bar laravel', LarStr::replace('baz', 'laravel', 'foo bar Baz', false));
        $this->assertSame('foo bar baz 8.x', LarStr::replace('?', '8.x', 'foo bar baz ?'));
        $this->assertSame('foo bar baz 8.x', LarStr::replace('x', '8.x', 'foo bar baz X', false));
        $this->assertSame('foo/bar/baz', LarStr::replace(' ', '/', 'foo bar baz'));
        $this->assertSame('foo bar baz', LarStr::replace(['?1', '?2', '?3'], ['foo', 'bar', 'baz'], '?1 ?2 ?3'));
        // $this->assertSame(['foo', 'bar', 'baz'], LarStr::replace(collect(['?1', '?2', '?3']), collect(['foo', 'bar', 'baz']), collect(['?1', '?2', '?3'])));
    }
}
