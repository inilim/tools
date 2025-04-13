<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class replaceTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo bar explosion', Str::replace('baz', 'explosion', 'foo bar baz'));
        $this->assertSame('foo bar explosion', Str::replace('baz', 'explosion', 'foo bar Baz', false));
        $this->assertSame('foo bar baz 8.x', Str::replace('?', '8.x', 'foo bar baz ?'));
        $this->assertSame('foo bar baz 8.x', Str::replace('x', '8.x', 'foo bar baz X', false));
        $this->assertSame('foo/bar/baz', Str::replace(' ', '/', 'foo bar baz'));
        $this->assertSame('foo bar baz', Str::replace(['?1', '?2', '?3'], ['foo', 'bar', 'baz'], '?1 ?2 ?3'));
        // $this->assertSame(['foo', 'bar', 'baz'], Str::replace(collect(['?1', '?2', '?3']), collect(['foo', 'bar', 'baz']), collect(['?1', '?2', '?3'])));
    }
}
