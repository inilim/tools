<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\PF;
use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isIntUnsignedTest extends TestCase
{
    function testRange()
    {
        $generator = (static function () {
            $is32Bit = \PHP_INT_SIZE === 4;

            for ($i = 0; $i <= 50_000; $i++) {
                if ($is32Bit) {
                    // TODO придумать
                    $i = \mt_rand(Integer::INT_UNSIGNED_MIN, \PHP_INT_MAX);
                    // 2_147_483_648;
                    // 2_147_483_647;
                    // \mt_rand(0, Integer::INT_MAX);
                    // PF::str_increment()
                    yield $i;
                } else {
                    yield \mt_rand(Integer::INT_UNSIGNED_MIN, Integer::INT_UNSIGNED_MAX);
                }
            }
        })();

        foreach ($generator as $num) {
            $this->assertTrue(Integer::isIntUnsigned($num));
            $this->assertTrue(Integer::isIntUnsigned(\strval($num)));
        }
    }

    function testFalse()
    {
        $is32Bit = \PHP_INT_SIZE === 4;

        if ($is32Bit) {
            $this->assertFalse(Integer::isIntUnsigned(PF::str_increment(\strval(Integer::INT_UNSIGNED_MAX_AS_STRING))));
            $this->assertFalse(Integer::isIntUnsigned(Integer::strDecrement(\strval(Integer::INT_UNSIGNED_MIN))));
        } else {
            $this->assertFalse(Integer::isIntUnsigned(\strval(Integer::INT_UNSIGNED_MIN - 1)));
            $this->assertFalse(Integer::isIntUnsigned(\strval(Integer::INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));
            $this->assertFalse(Integer::isIntUnsigned((Integer::INT_UNSIGNED_MIN - 1)));
            $this->assertFalse(Integer::isIntUnsigned((Integer::INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));

            $this->assertFalse(Integer::isIntUnsigned((Integer::INT_UNSIGNED_MAX + 1)));
            $this->assertFalse(Integer::isIntUnsigned((Integer::INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));
            $this->assertFalse(Integer::isIntUnsigned(\strval(Integer::INT_UNSIGNED_MAX + 1)));
            $this->assertFalse(Integer::isIntUnsigned(\strval(Integer::INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));
        }
    }
}
