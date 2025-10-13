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
        $this->assertTrue(Integer::isNumeric(\strval(\PHP_INT_MAX)));
        $this->assertTrue(Integer::isNumeric(\PHP_INT_MAX));
        $this->assertTrue(Integer::isNumeric(\strval(\PHP_INT_MIN)));
        $this->assertTrue(Integer::isNumeric(\PHP_INT_MIN));
    }

    function testFalse()
    {
        $this->assertFalse(Integer::isNumeric(1.2));
        $this->assertFalse(Integer::isNumeric('01'));
        $this->assertFalse(Integer::isNumeric('-0'));
        $this->assertFalse(Integer::isNumeric('-01'));
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
    }
}
