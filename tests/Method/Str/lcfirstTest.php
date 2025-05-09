<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class lcfirstTest extends TestCase
{
    function test()
    {
        $this->assertSame('explosion', Str::lcfirst('Explosion'));
        $this->assertSame('explosion tools', Str::lcfirst('Explosion tools'));
        $this->assertSame('мама', Str::lcfirst('Мама'));
        $this->assertSame('мама мыла раму', Str::lcfirst('Мама мыла раму'));
    }
}
