<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class headlineTest extends TestCase
{
    function test()
    {
        $this->assertSame('Jefferson Costella', LarStr::headline('jefferson costella'));
        $this->assertSame('Jefferson Costella', LarStr::headline('jefFErson coSTella'));
        $this->assertSame('Jefferson Costella Uses Laravel', LarStr::headline('jefferson_costella uses-_Laravel'));
        $this->assertSame('Jefferson Costella Uses Laravel', LarStr::headline('jefferson_costella uses__Laravel'));

        $this->assertSame('Laravel P H P Framework', LarStr::headline('laravel_p_h_p_framework'));
        $this->assertSame('Laravel P H P Framework', LarStr::headline('laravel _p _h _p _framework'));
        $this->assertSame('Laravel Php Framework', LarStr::headline('laravel_php_framework'));
        $this->assertSame('Laravel Ph P Framework', LarStr::headline('laravel-phP-framework'));
        $this->assertSame('Laravel Php Framework', LarStr::headline('laravel  -_-  php   -_-   framework   '));

        $this->assertSame('Foo Bar', LarStr::headline('fooBar'));
        $this->assertSame('Foo Bar', LarStr::headline('foo_bar'));
        $this->assertSame('Foo Bar Baz', LarStr::headline('foo-barBaz'));
        $this->assertSame('Foo Bar Baz', LarStr::headline('foo-bar_baz'));

        $this->assertSame('Öffentliche Überraschungen', LarStr::headline('öffentliche-überraschungen'));
        $this->assertSame('Öffentliche Überraschungen', LarStr::headline('-_öffentliche_überraschungen_-'));
        $this->assertSame('Öffentliche Überraschungen', LarStr::headline('-öffentliche überraschungen'));

        $this->assertSame('Sind Öde Und So', LarStr::headline('sindÖdeUndSo'));

        $this->assertSame('❤ Multi Byte ☆', LarStr::headline('❤_multiByte-☆'));

        $this->assertSame('Orwell 1984', LarStr::headline('orwell 1984'));
        $this->assertSame('Orwell 1984', LarStr::headline('orwell   1984'));
        $this->assertSame('Orwell 1984', LarStr::headline('-orwell-1984 -'));
        $this->assertSame('Orwell 1984', LarStr::headline(' orwell_- 1984 '));

        $this->assertSame('Laravel Rocks!', LarStr::headline('laravel rocks!'));
    }
}
