<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\PF;
use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isBigIntTest extends TestCase
{
    function testRange()
    {
        $generator = (static function () {
            $is32Bit = \PHP_INT_SIZE === 4;

            for ($i = 0; $i <= 50_000; $i++) {
                if ($is32Bit) {
                    // TODO придумать
                    $i = \mt_rand(\PHP_INT_MIN, \PHP_INT_MAX);
                    // 2_147_483_648;
                    // 2_147_483_647;
                    // \mt_rand(0, Integer::INT_MAX);
                    // PF::str_increment()
                    yield $i;
                } else {
                    yield \mt_rand(Integer::BIG_INT_MIN, Integer::BIG_INT_MAX);
                }
            }
        })();

        foreach ($generator as $num) {
            $this->assertTrue(Integer::isBigInt($num));
            $this->assertTrue(Integer::isBigInt(\strval($num)));
        }
    }

    function testFalse()
    {
        $this->assertFalse(Integer::isBigInt(PF::str_increment(Integer::BIG_INT_MAX_AS_STRING)));
        $this->assertFalse(Integer::isBigInt(Integer::strDecrement(Integer::BIG_INT_MIN_AS_STRING)));
    }
}
