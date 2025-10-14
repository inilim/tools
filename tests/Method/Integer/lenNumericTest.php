<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class lenNumericTest extends TestCase
{
    function testTrue()
    {

        $this->assertTrue(Integer::lenNumeric(2147483647) === 10);
        $this->assertTrue(Integer::lenNumeric(-2147483648) === 10);
        $this->assertTrue(Integer::lenNumeric('1231782637126381623761287361872638716238761872637162837') === 55);
        $this->assertTrue(Integer::lenNumeric('-1231782637126381623761287361872638716238761872637162837') === 55);
        $this->assertTrue(Integer::lenNumeric('9223372036854775807') === 19);
        $this->assertTrue(Integer::lenNumeric('-9223372036854775808') === 19);
        $this->assertTrue(Integer::lenNumeric(1) === 1);
        $this->assertTrue(Integer::lenNumeric(-1) === 1);
        $this->assertTrue(Integer::lenNumeric('1') === 1);
        $this->assertTrue(Integer::lenNumeric('-1') === 1);
        $this->assertTrue(Integer::lenNumeric('11') === 2);
        $this->assertTrue(Integer::lenNumeric('-11') === 2);
        $this->assertTrue(Integer::lenNumeric(11) === 2);
        $this->assertTrue(Integer::lenNumeric(-11) === 2);
        $this->assertTrue(Integer::lenNumeric('111') === 3);
        $this->assertTrue(Integer::lenNumeric('1111') === 4);
        $this->assertTrue(Integer::lenNumeric('11111') === 5);
        $this->assertTrue(Integer::lenNumeric('111111') === 6);
        $this->assertTrue(Integer::lenNumeric('1111111') === 7);
        $this->assertTrue(Integer::lenNumeric('11111111') === 8);
        $this->assertTrue(Integer::lenNumeric('111111111') === 9);
        $this->assertTrue(Integer::lenNumeric('1111111111') === 10);
    }

    function testException()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::lenNumeric('');
    }
    function testException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::lenNumeric('01');
    }
    function testException3()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::lenNumeric('-0');
    }
    function testException4()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::lenNumeric('a');
    }
}
