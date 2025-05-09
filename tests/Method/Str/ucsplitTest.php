<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class ucsplitTest extends TestCase
{
    function test()
    {
        $this->assertSame(['Explosion_p_h_p_tools'], Str::ucsplit('Explosion_p_h_p_tools'));
        $this->assertSame(['Explosion_', 'P_h_p_tools'], Str::ucsplit('Explosion_P_h_p_tools'));
        $this->assertSame(['explosion', 'P', 'H', 'P', 'Tools'], Str::ucsplit('explosionPHPTools'));
        $this->assertSame(['Explosion-ph', 'P-tools'], Str::ucsplit('Explosion-phP-tools'));

        $this->assertSame(['Żółta', 'Łódka'], Str::ucsplit('ŻółtaŁódka'));
        $this->assertSame(['sind', 'Öde', 'Und', 'So'], Str::ucsplit('sindÖdeUndSo'));
        $this->assertSame(['Öffentliche', 'Überraschungen'], Str::ucsplit('ÖffentlicheÜberraschungen'));
    }
}
