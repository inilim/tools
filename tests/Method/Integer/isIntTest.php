<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\PF;
use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isIntTest extends TestCase
{
    function testRange()
    {
        $generator = (static function () {
            for ($i = 0; $i <= 50_000; $i++) {
                yield \mt_rand(Integer::INT_MIN, Integer::INT_MAX);
            }
        })();

        foreach ($generator as $num) {
            $this->assertTrue(Integer::isInt($num));
            $this->assertTrue(Integer::isInt(\strval($num)));
        }
    }

    function testFalse()
    {
        $is32Bit = \PHP_INT_SIZE === 4;

        if ($is32Bit) {
            $this->assertFalse(Integer::isInt(Integer::strDecrement(\strval(Integer::INT_MIN))));
            $this->assertFalse(Integer::isInt(PF::str_increment(\strval(Integer::INT_MAX))));
        } else {
            $this->assertFalse(Integer::isInt(\strval(Integer::INT_MIN - 1)));
            $this->assertFalse(Integer::isInt(\strval(Integer::INT_MIN - \mt_rand(1, \PHP_INT_MAX))));
            $this->assertFalse(Integer::isInt((Integer::INT_MIN - 1)));
            $this->assertFalse(Integer::isInt((Integer::INT_MIN - \mt_rand(1, \PHP_INT_MAX))));

            $this->assertFalse(Integer::isInt((Integer::INT_MAX + 1)));
            $this->assertFalse(Integer::isInt((Integer::INT_MAX + \mt_rand(1, \PHP_INT_MAX))));
            $this->assertFalse(Integer::isInt(\strval(Integer::INT_MAX + 1)));
            $this->assertFalse(Integer::isInt(\strval(Integer::INT_MAX + \mt_rand(1, \PHP_INT_MAX))));

            $this->assertFalse(Integer::isInt(\PHP_INT_MAX));
            $this->assertFalse(Integer::isInt(\PHP_INT_MIN));

            $this->assertFalse(Integer::isInt(\strval(\PHP_INT_MAX)));
            $this->assertFalse(Integer::isInt(\strval(\PHP_INT_MIN)));
        }
    }
}
