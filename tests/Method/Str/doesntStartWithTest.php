<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class doesntStartWithTest extends TestCase
{
    function test()
    {
        $this->assertFalse(Str::doesntStartWith('jason', 'jas'));
        $this->assertFalse(Str::doesntStartWith('jason', 'jason'));
        $this->assertFalse(Str::doesntStartWith('jason', ['jas']));
        $this->assertFalse(Str::doesntStartWith('jason', ['day', 'jas']));
        $this->assertFalse(Str::doesntStartWith('jason', new ClassArrayAccessIteratorAggregate(['day', 'jas'])));
        $this->assertTrue(Str::doesntStartWith('jason', 'day'));
        $this->assertTrue(Str::doesntStartWith('jason', ['day']));
        // $this->assertTrue(Str::doesntStartWith('jason', null));
        // $this->assertTrue(Str::doesntStartWith('jason', [null]));
        // $this->assertTrue(Str::doesntStartWith('0123', [null]));
        $this->assertFalse(Str::doesntStartWith('0123', '0'));
        $this->assertTrue(Str::doesntStartWith('jason', 'J'));
        $this->assertTrue(Str::doesntStartWith('jason', ''));
        $this->assertTrue(Str::doesntStartWith('', ''));
        $this->assertTrue(Str::doesntStartWith('7', ' 7'));
        $this->assertFalse(Str::doesntStartWith('7a', '7'));
        $this->assertFalse(Str::doesntStartWith('7a', '7'));
        $this->assertFalse(Str::doesntStartWith('7.12a', '7.12'));
        $this->assertTrue(Str::doesntStartWith('7.12a', '7.13'));
        $this->assertFalse(Str::doesntStartWith('7.123', '7'));
        $this->assertFalse(Str::doesntStartWith('7.123', '7.12'));
        $this->assertTrue(Str::doesntStartWith('7.123', '7.13'));
        // $this->assertTrue(Str::doesntStartWith(null, 'Marc'));
        // Test for multibyte string support
        $this->assertFalse(Str::doesntStartWith('Jönköping', 'Jö'));
        $this->assertFalse(Str::doesntStartWith('Malmö', 'Malmö'));
        $this->assertTrue(Str::doesntStartWith('Jönköping', 'Jonko'));
        $this->assertTrue(Str::doesntStartWith('Malmö', 'Malmo'));
        $this->assertFalse(Str::doesntStartWith('你好', '你'));
        $this->assertTrue(Str::doesntStartWith('你好', '好'));
        $this->assertTrue(Str::doesntStartWith('你好', 'a'));
    }
}
