<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class headlineTest extends TestCase
{
    function test()
    {
        $this->assertSame('Jefferson Costella', Str::headline('jefferson costella'));
        $this->assertSame('Jefferson Costella', Str::headline('jefFErson coSTella'));
        $this->assertSame('Jefferson Costella Uses Explosion', Str::headline('jefferson_costella uses-_Explosion'));
        $this->assertSame('Jefferson Costella Uses Explosion', Str::headline('jefferson_costella uses__Explosion'));

        $this->assertSame('Explosion P H P Tools', Str::headline('explosion_p_h_p_tools'));
        $this->assertSame('Explosion P H P Tools', Str::headline('explosion _p _h _p _tools'));
        $this->assertSame('Explosion Php Tools', Str::headline('explosion_php_tools'));
        $this->assertSame('Explosion Ph P Tools', Str::headline('explosion-phP-tools'));
        $this->assertSame('Explosion Php Tools', Str::headline('explosion  -_-  php   -_-   tools   '));

        $this->assertSame('Foo Bar', Str::headline('fooBar'));
        $this->assertSame('Foo Bar', Str::headline('foo_bar'));
        $this->assertSame('Foo Bar Baz', Str::headline('foo-barBaz'));
        $this->assertSame('Foo Bar Baz', Str::headline('foo-bar_baz'));

        $this->assertSame('Öffentliche Überraschungen', Str::headline('öffentliche-überraschungen'));
        $this->assertSame('Öffentliche Überraschungen', Str::headline('-_öffentliche_überraschungen_-'));
        $this->assertSame('Öffentliche Überraschungen', Str::headline('-öffentliche überraschungen'));

        $this->assertSame('Sind Öde Und So', Str::headline('sindÖdeUndSo'));

        $this->assertSame('Orwell 1984', Str::headline('orwell 1984'));
        $this->assertSame('Orwell 1984', Str::headline('orwell   1984'));
        $this->assertSame('Orwell 1984', Str::headline('-orwell-1984 -'));
        $this->assertSame('Orwell 1984', Str::headline(' orwell_- 1984 '));
    }
}
