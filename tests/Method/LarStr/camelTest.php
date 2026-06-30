<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class camelTest extends TestCase
{
    function test()
    {
        $this->assertSame('laravelPHPFramework', LarStr::camel('Laravel_p_h_p_framework'));
        $this->assertSame('laravelPhpFramework', LarStr::camel('Laravel_php_framework'));
        $this->assertSame('laravelPhPFramework', LarStr::camel('Laravel-phP-framework'));
        $this->assertSame('laravelPhpFramework', LarStr::camel('Laravel  -_-  php   -_-   framework   '));

        $this->assertSame('fooBar', LarStr::camel('FooBar'));
        $this->assertSame('fooBar', LarStr::camel('foo_bar'));
        $this->assertSame('fooBar', LarStr::camel('foo_bar')); // test cache
        $this->assertSame('fooBarBaz', LarStr::camel('Foo-barBaz'));
        $this->assertSame('fooBarBaz', LarStr::camel('foo-bar_baz'));

        $this->assertSame('', LarStr::camel(''));
        $this->assertSame('lARAVELPHPFRAMEWORK', LarStr::camel('LARAVEL_PHP_FRAMEWORK'));
        $this->assertSame('laravelPhpFramework', LarStr::camel('   laravel   php   framework   '));

        $this->assertSame('foo1Bar', LarStr::camel('foo1_bar'));
        $this->assertSame('1FooBar', LarStr::camel('1 foo bar'));
    }
}
