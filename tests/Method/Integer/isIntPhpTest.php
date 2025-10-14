<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\PF;
use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isIntPhpTest extends TestCase
{
    function testTrue()
    {
        $is32Bit = \PHP_INT_SIZE === 4;

        if ($is32Bit) {
            $this->assertTrue(Integer::isIntPhp(2147483647));
            $this->assertTrue(Integer::isIntPhp(-2147483648));
        } else {
            $this->assertTrue(Integer::isIntPhp(9223372036854775807));
            // INFO Константа PHP_INT_MIN хорошо конвертируется в строку, а вот если задать число то конвертация ломает целостность
            // -9223372036854775808 > "-9.2233720368548E+18"
            // PHP_INT_MIN > "-9223372036854775808"
            $this->assertTrue(Integer::isIntPhp(-9223372036854775807));
        }

        $this->assertTrue(Integer::isIntPhp(\PHP_INT_MAX));
        $this->assertTrue(Integer::isIntPhp(\PHP_INT_MIN));
        $this->assertTrue(Integer::isIntPhp(1));
        $this->assertTrue(Integer::isIntPhp(-1));
        $this->assertTrue(Integer::isIntPhp(0));
    }

    function testFalse()
    {
        $is32Bit = \PHP_INT_SIZE === 4;

        if ($is32Bit) {
            $this->assertFalse(Integer::isIntPhp(2147483648));
            $this->assertFalse(Integer::isIntPhp(-2147483649));
        } else {
            $this->assertFalse(Integer::isIntPhp(9223372036854775808));
            $this->assertFalse(Integer::isIntPhp(-9223372036854775809));
        }

        $this->assertFalse(Integer::isIntPhp(''));
        $this->assertFalse(Integer::isIntPhp(' '));
        $this->assertFalse(Integer::isIntPhp('a'));
        $this->assertFalse(Integer::isIntPhp('-0'));
        $this->assertFalse(Integer::isIntPhp('01'));
    }
}
