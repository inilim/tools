<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class isUrlTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Str::isUrl('https://explosion.com'));
        $this->assertTrue(Str::isUrl('http://localhost'));
        $this->assertFalse(Str::isUrl('invalid url'));
    }
}
