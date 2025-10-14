<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\PF;
use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isIntPhp_m2Test extends TestCase
{
    function testTrue()
    {
        $is32Bit = \PHP_INT_SIZE === 4;

        if ($is32Bit) {
            $this->assertTrue(Integer::isIntPhp_m2(2147483647));
            $this->assertTrue(Integer::isIntPhp_m2(-2147483648));
        } else {
            $this->assertTrue(Integer::isIntPhp_m2(9223372036854775807));
            // INFO Константа PHP_INT_MIN хорошо конвертируется в строку, а вот если задать число то конвертация ломает целостность
            // -9223372036854775808 > "-9.2233720368548E+18"
            // PHP_INT_MIN > "-9223372036854775808"
            $this->assertTrue(Integer::isIntPhp_m2(-9223372036854775807));
        }

        $this->assertTrue(Integer::isIntPhp_m2(\PHP_INT_MAX));
        $this->assertTrue(Integer::isIntPhp_m2(\PHP_INT_MIN));
        $this->assertTrue(Integer::isIntPhp_m2(1));
        $this->assertTrue(Integer::isIntPhp_m2(-1));
        $this->assertTrue(Integer::isIntPhp_m2(0));
    }

    function testFalse()
    {
        $is32Bit = \PHP_INT_SIZE === 4;

        if ($is32Bit) {
            $this->assertFalse(Integer::isIntPhp_m2(2147483648));
            $this->assertFalse(Integer::isIntPhp_m2(-2147483649));
        } else {
            $this->assertFalse(Integer::isIntPhp_m2('9223372036854775808'));
            $this->assertFalse(Integer::isIntPhp_m2('-9223372036854775809'));
        }
    }

    function testException()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::isIntPhp_m2('');
    }
    function testException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::isIntPhp_m2(' ');
    }
    function testException3()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::isIntPhp_m2('a');
    }
    function testException4()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::isIntPhp_m2('-0');
    }
    function testException5()
    {
        $this->expectException(\InvalidArgumentException::class);
        Integer::isIntPhp_m2('01');
    }
}
