<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class camelTest extends TestCase
{
    function test()
    {
        $this->assertSame('explosionPHPTools', Str::camel('Explosion_p_h_p_tools'));
        $this->assertSame('explosionPhpTools', Str::camel('Explosion_php_tools'));
        $this->assertSame('explosionPhPTools', Str::camel('Explosion-phP-tools'));
        $this->assertSame('explosionPhpTools', Str::camel('Explosion  -_-  php   -_-   tools   '));

        $this->assertSame('fooBar', Str::camel('FooBar'));
        $this->assertSame('fooBar', Str::camel('foo_bar'));
        $this->assertSame('fooBar', Str::camel('foo_bar')); // test cache
        $this->assertSame('fooBarBaz', Str::camel('Foo-barBaz'));
        $this->assertSame('fooBarBaz', Str::camel('foo-bar_baz'));

        $this->assertSame('', Str::camel(''));
        $this->assertSame('lARAVELPHPFRAMEWORK', Str::camel('LARAVEL_PHP_FRAMEWORK'));
        $this->assertSame('explosionPhpTools', Str::camel('   explosion   php   tools   '));

        $this->assertSame('foo1Bar', Str::camel('foo1_bar'));
        $this->assertSame('1FooBar', Str::camel('1 foo bar'));
    }
}
