<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isNumericTest extends TestCase
{
    function testTrue()
    {
        $this->assertTrue(Integer::isNumeric(\mt_rand(10_000_000, 99_999_999)));
        $this->assertTrue(Integer::isNumeric(\mt_rand(1_000_000, 9_999_999)));
        $this->assertTrue(Integer::isNumeric(\mt_rand(100_000, 999_999)));
        $this->assertTrue(Integer::isNumeric(\mt_rand(10_000, 99_999)));
        $this->assertTrue(Integer::isNumeric(\mt_rand(1000, 9999)));
        $this->assertTrue(Integer::isNumeric(1));
        $this->assertTrue(Integer::isNumeric('1'));
        $this->assertTrue(Integer::isNumeric('12345678999999999999999999999999999999999999999999999'));
        $this->assertTrue(Integer::isNumeric('-1'));
        $this->assertTrue(Integer::isNumeric(-1));
        $this->assertTrue(Integer::isNumeric('-1234567899999999999999999999999999999999999999999999'));
        $this->assertTrue(Integer::isNumeric('92233720368547758072'));
        $this->assertTrue(Integer::isNumeric('-92233720368547758072'));
        $this->assertTrue(Integer::isNumeric(\strval(\PHP_INT_MAX)));
        $this->assertTrue(Integer::isNumeric(\PHP_INT_MAX));
        $this->assertTrue(Integer::isNumeric(\strval(\PHP_INT_MIN)));
        $this->assertTrue(Integer::isNumeric(\PHP_INT_MIN));

        // as \is_numeric()
        $this->assertTrue(Integer::isNumeric("42"));
        $this->assertTrue(Integer::isNumeric(1337));
        $this->assertTrue(Integer::isNumeric(0x539));
        $this->assertTrue(Integer::isNumeric(02471));
        $this->assertTrue(Integer::isNumeric(0b10100111001));
        // 
    }

    function testFalse()
    {
        // сверх больше числа конвертируются в float
        $this->assertFalse(Integer::isNumeric(92233720368547758072));
        $this->assertFalse(Integer::isNumeric(-92233720368547758072));

        // not as \is_numeric()
        $this->assertFalse(Integer::isNumeric("0x539"));
        $this->assertFalse(Integer::isNumeric("02471"));
        $this->assertFalse(Integer::isNumeric("0b10100111001"));
        $this->assertFalse(Integer::isNumeric("1337e0"));
        $this->assertFalse(Integer::isNumeric(1337e0));
        $this->assertFalse(Integer::isNumeric(9.1));
        $this->assertFalse(Integer::isNumeric(null));
        $this->assertFalse(Integer::isNumeric(" 42"));
        $this->assertFalse(Integer::isNumeric("42 "));
        $this->assertFalse(Integer::isNumeric("\u{A0}9001"));
        $this->assertFalse(Integer::isNumeric("9001\u{A0}"));
        // 

        $this->assertFalse(Integer::isNumeric(1.0));
        $this->assertFalse(Integer::isNumeric(2.0));
        $this->assertFalse(Integer::isNumeric(1.2));
        $this->assertFalse(Integer::isNumeric('01'));
        $this->assertFalse(Integer::isNumeric('-0'));
        $this->assertFalse(Integer::isNumeric('-01'));
        $this->assertFalse(Integer::isNumeric('1.0'));
        $this->assertFalse(Integer::isNumeric('2.0'));
        $this->assertFalse(Integer::isNumeric('1.2'));
        $this->assertFalse(Integer::isNumeric('01.2'));
        $this->assertFalse(Integer::isNumeric('-1.2'));
        $this->assertFalse(Integer::isNumeric('-0.2'));
        $this->assertFalse(Integer::isNumeric('-01.2'));
        $this->assertFalse(Integer::isNumeric('a'));
        $this->assertFalse(Integer::isNumeric('abc'));
        $this->assertFalse(Integer::isNumeric(' '));
        $this->assertFalse(Integer::isNumeric(''));
        $this->assertFalse(Integer::isNumeric('-'));
        $this->assertFalse(Integer::isNumeric("\n"));
    }
}
