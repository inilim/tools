<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class doesntEndWithTest extends TestCase
{
    function test()
    {
        $this->assertFalse(Str::doesntEndWith('jason', 'on'));
        $this->assertFalse(Str::doesntEndWith('jason', 'jason'));
        $this->assertFalse(Str::doesntEndWith('jason', ['on']));
        $this->assertFalse(Str::doesntEndWith('jason', ['no', 'on']));
        $this->assertFalse(Str::doesntEndWith('jason', new ClassArrayAccessIteratorAggregate(['no', 'on'])));
        $this->assertTrue(Str::doesntEndWith('jason', 'no'));
        $this->assertTrue(Str::doesntEndWith('jason', ['no']));
        $this->assertTrue(Str::doesntEndWith('jason', ''));
        $this->assertTrue(Str::doesntEndWith('', ''));
        // $this->assertTrue(Str::doesntEndWith('jason', [null]));
        // $this->assertTrue(Str::doesntEndWith('jason', null));
        $this->assertTrue(Str::doesntEndWith('jason', 'N'));
        $this->assertTrue(Str::doesntEndWith('7', ' 7'));
        $this->assertFalse(Str::doesntEndWith('a7', '7'));
        $this->assertFalse(Str::doesntEndWith('a7', '7'));
        $this->assertFalse(Str::doesntEndWith('a7.12', '7.12'));
        $this->assertTrue(Str::doesntEndWith('a7.12', '7.13'));
        $this->assertFalse(Str::doesntEndWith('0.27', '7'));
        $this->assertFalse(Str::doesntEndWith('0.27', '0.27'));
        $this->assertTrue(Str::doesntEndWith('0.27', '8'));
        // $this->assertTrue(Str::doesntEndWith(null, 'Marc'));
        // Test for multibyte string support
        $this->assertFalse(Str::doesntEndWith('Jönköping', 'öping'));
        $this->assertFalse(Str::doesntEndWith('Malmö', 'mö'));
        $this->assertTrue(Str::doesntEndWith('Jönköping', 'oping'));
        $this->assertTrue(Str::doesntEndWith('Malmö', 'mo'));
        $this->assertFalse(Str::doesntEndWith('你好', '好'));
        $this->assertTrue(Str::doesntEndWith('你好', '你'));
        $this->assertTrue(Str::doesntEndWith('你好', 'a'));
    }
}
