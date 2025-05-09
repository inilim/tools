<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class ucfirstTest extends TestCase
{
    function test()
    {
        $this->assertSame('Explosion', Str::ucfirst('explosion'));
        $this->assertSame('Explosion tools', Str::ucfirst('explosion tools'));
        $this->assertSame('Мама', Str::ucfirst('мама'));
        $this->assertSame('Мама мыла раму', Str::ucfirst('мама мыла раму'));
    }
}
