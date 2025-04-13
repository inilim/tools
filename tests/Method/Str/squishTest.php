<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class squishTest extends TestCase
{
    function test()
    {
        $this->assertSame('explosion php tools', Str::squish(' explosion   php  tools '));
        $this->assertSame('explosion php tools', Str::squish("explosion\t\tphp\n\ntools"));
        $this->assertSame('explosion php tools', Str::squish('
            explosion
            php
            tools
        '));
        $this->assertSame('explosion php tools', Str::squish('   explosion   php   tools   '));
        $this->assertSame('123', Str::squish('   123    '));
        $this->assertSame('だ', Str::squish('だ'));
        $this->assertSame('ム', Str::squish('ム'));
        $this->assertSame('だ', Str::squish('   だ    '));
        $this->assertSame('ム', Str::squish('   ム    '));
        $this->assertSame('explosion php tools', Str::squish('explosionㅤㅤㅤphpㅤtools'));
        $this->assertSame('explosion php tools', Str::squish('explosionᅠᅠᅠᅠᅠᅠᅠᅠᅠᅠphpᅠᅠtools'));
    }
}
