<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class ucsplitTest extends TestCase
{
    function test()
    {
        $this->assertSame(['Laravel_p_h_p_framework'], LarStr::ucsplit('Laravel_p_h_p_framework'));
        $this->assertSame(['Laravel_', 'P_h_p_framework'], LarStr::ucsplit('Laravel_P_h_p_framework'));
        $this->assertSame(['laravel', 'P', 'H', 'P', 'Framework'], LarStr::ucsplit('laravelPHPFramework'));
        $this->assertSame(['Laravel-ph', 'P-framework'], LarStr::ucsplit('Laravel-phP-framework'));

        $this->assertSame(['Żółta', 'Łódka'], LarStr::ucsplit('ŻółtaŁódka'));
        $this->assertSame(['sind', 'Öde', 'Und', 'So'], LarStr::ucsplit('sindÖdeUndSo'));
        $this->assertSame(['Öffentliche', 'Überraschungen'], LarStr::ucsplit('ÖffentlicheÜberraschungen'));
    }
}
