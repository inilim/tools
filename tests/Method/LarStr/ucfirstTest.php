<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class ucfirstTest extends TestCase
{
    function test()
    {
        $this->assertSame('Laravel', LarStr::ucfirst('laravel'));
        $this->assertSame('Laravel framework', LarStr::ucfirst('laravel framework'));
        $this->assertSame('Мама', LarStr::ucfirst('мама'));
        $this->assertSame('Мама мыла раму', LarStr::ucfirst('мама мыла раму'));
    }
}
