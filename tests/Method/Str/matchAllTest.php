<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class matchAllTest extends TestCase
{
    function test()
    {
        $this->assertEquals(['bar', 'bar'], Str::matchAll('/bar/', 'bar foo bar'));
        $this->assertEquals(['un', 'ly'], Str::matchAll('/f(\w*)/', 'bar fun bar fly'));
        $this->assertEmpty(Str::matchAll('/nothing/', 'bar fun bar fly'));
        $this->assertEmpty(Str::matchAll('/pattern/', ''));
    }
}
