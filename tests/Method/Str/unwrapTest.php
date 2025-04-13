<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class unwrapTest extends TestCase
{
    function test()
    {
        $this->assertEquals('value', Str::unwrap('"value"', '"'));
        $this->assertEquals('value', Str::unwrap('"value', '"'));
        $this->assertEquals('value', Str::unwrap('value"', '"'));
        $this->assertEquals('bar', Str::unwrap('foo-bar-baz', 'foo-', '-baz'));
        $this->assertEquals('some: "json"', Str::unwrap('{some: "json"}', '{', '}'));
    }
}
