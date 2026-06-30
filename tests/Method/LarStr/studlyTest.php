<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class studlyTest extends TestCase
{
    function test()
    {
        $this->assertSame('LaravelPHPFramework', LarStr::studly('laravel_p_h_p_framework'));
        $this->assertSame('LaravelPhpFramework', LarStr::studly('laravel_php_framework'));
        $this->assertSame('LaravelPhPFramework', LarStr::studly('laravel-phP-framework'));
        $this->assertSame('LaravelPhpFramework', LarStr::studly('laravel  -_-  php   -_-   framework   '));

        $this->assertSame('FooBar', LarStr::studly('fooBar'));
        $this->assertSame('FooBar', LarStr::studly('foo_bar'));
        $this->assertSame('FooBar', LarStr::studly('foo_bar')); // test cache
        $this->assertSame('FooBarBaz', LarStr::studly('foo-barBaz'));
        $this->assertSame('FooBarBaz', LarStr::studly('foo-bar_baz'));

        $this->assertSame('ÖffentlicheÜberraschungen', LarStr::studly('öffentliche-überraschungen'));
        $this->assertSame('❤MultiByte☆', LarStr::studly('❤ multi-byte☆'));

        $this->assertSame('LaravelRocks!', LarStr::studly('laravel rocks!'));

        // normalize: true — all-uppercase words (acronyms) are treated as single words
        $this->assertSame('Cbor', LarStr::studly('CBOR', true));
        $this->assertSame('Fmls', LarStr::studly('FMLS', true));
        $this->assertSame('AllCaps', LarStr::studly('ALL_CAPS', true));
        $this->assertSame('AllJersey', LarStr::studly('AllJersey', true));
        $this->assertSame('AllJersey', LarStr::studly('all_jersey', true));
        $this->assertSame('FooBar', LarStr::studly('foo_bar', true));
    }
}
