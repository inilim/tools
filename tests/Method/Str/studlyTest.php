<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class studlyTest extends TestCase
{
    function test()
    {
        $this->assertSame('ExplosionPHPTools', Str::studly('explosion_p_h_p_tools'));
        $this->assertSame('ExplosionPhpTools', Str::studly('explosion_php_tools'));
        $this->assertSame('ExplosionPhPTools', Str::studly('explosion-phP-tools'));
        $this->assertSame('ExplosionPhpTools', Str::studly('explosion  -_-  php   -_-   tools   '));

        $this->assertSame('FooBar', Str::studly('fooBar'));
        $this->assertSame('FooBar', Str::studly('foo_bar'));
        $this->assertSame('FooBar', Str::studly('foo_bar')); // test cache
        $this->assertSame('FooBarBaz', Str::studly('foo-barBaz'));
        $this->assertSame('FooBarBaz', Str::studly('foo-bar_baz'));

        $this->assertSame('ÖffentlicheÜberraschungen', Str::studly('öffentliche-überraschungen'));
    }
}
