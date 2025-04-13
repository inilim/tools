<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class removeTest extends TestCase
{
    function test()
    {
        $this->assertSame('Fbar', Str::remove('o', 'Foobar'));
        $this->assertSame('Foo', Str::remove('bar', 'Foobar'));
        $this->assertSame('oobar', Str::remove('F', 'Foobar'));
        $this->assertSame('Foobar', Str::remove('f', 'Foobar'));
        $this->assertSame('oobar', Str::remove('f', 'Foobar', false));

        $this->assertSame('Fbr', Str::remove(['o', 'a'], 'Foobar'));
        $this->assertSame('Fooar', Str::remove(['f', 'b'], 'Foobar'));
        $this->assertSame('ooar', Str::remove(['f', 'b'], 'Foobar', false));
        $this->assertSame('Foobar', Str::remove(['f', '|'], 'Foo|bar'));
    }
}
