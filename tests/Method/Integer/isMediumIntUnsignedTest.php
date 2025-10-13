<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isMediumIntUnsignedTest extends TestCase
{
    function testRange()
    {
        $generator = (static function () {
            for ($i = 0; $i <= 20_000; $i++) {
                yield \mt_rand(Integer::MEDIUM_INT_UNSIGNED_MIN, Integer::MEDIUM_INT_UNSIGNED_MAX);
            }
        })();

        foreach ($generator as $num) {
            $this->assertTrue(Integer::isMediumIntUnsigned($num));
            $this->assertTrue(Integer::isMediumIntUnsigned(\strval($num)));
        }
    }

    function testFalse()
    {
        $this->assertFalse(Integer::isMediumIntUnsigned(\strval(Integer::MEDIUM_INT_UNSIGNED_MIN - 1)));
        $this->assertFalse(Integer::isMediumIntUnsigned(\strval(Integer::MEDIUM_INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isMediumIntUnsigned((Integer::MEDIUM_INT_UNSIGNED_MIN - 1)));
        $this->assertFalse(Integer::isMediumIntUnsigned((Integer::MEDIUM_INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isMediumIntUnsigned((Integer::MEDIUM_INT_UNSIGNED_MAX + 1)));
        $this->assertFalse(Integer::isMediumIntUnsigned((Integer::MEDIUM_INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isMediumIntUnsigned(\strval(Integer::MEDIUM_INT_UNSIGNED_MAX + 1)));
        $this->assertFalse(Integer::isMediumIntUnsigned(\strval(Integer::MEDIUM_INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isMediumIntUnsigned(\PHP_INT_MAX));
        $this->assertFalse(Integer::isMediumIntUnsigned(\PHP_INT_MIN));

        $this->assertFalse(Integer::isMediumIntUnsigned(\strval(\PHP_INT_MAX)));
        $this->assertFalse(Integer::isMediumIntUnsigned(\strval(\PHP_INT_MIN)));
    }
}
