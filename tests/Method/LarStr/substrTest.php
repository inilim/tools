<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class substrTest extends TestCase
{
    function test()
    {
        $this->assertSame('Ё', LarStr::substr('БГДЖИЛЁ', -1));
        $this->assertSame('ЛЁ', LarStr::substr('БГДЖИЛЁ', -2));
        $this->assertSame('И', LarStr::substr('БГДЖИЛЁ', -3, 1));
        $this->assertSame('ДЖИЛ', LarStr::substr('БГДЖИЛЁ', 2, -1));
        $this->assertEmpty(LarStr::substr('БГДЖИЛЁ', 4, -4));
        $this->assertSame('ИЛ', LarStr::substr('БГДЖИЛЁ', -3, -1));
        $this->assertSame('ГДЖИЛЁ', LarStr::substr('БГДЖИЛЁ', 1));
        $this->assertSame('ГДЖ', LarStr::substr('БГДЖИЛЁ', 1, 3));
        $this->assertSame('БГДЖ', LarStr::substr('БГДЖИЛЁ', 0, 4));
        $this->assertSame('Ё', LarStr::substr('БГДЖИЛЁ', -1, 1));
        $this->assertEmpty(LarStr::substr('Б', 2));
    }
}
