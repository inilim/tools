<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isSmallIntUnsignedTest extends TestCase
{
    function testRange()
    {
        $generator = (static function () {
            $i = Integer::SMALL_INT_UNSIGNED_MIN;
            while (true) {
                if ($i >= Integer::SMALL_INT_UNSIGNED_MAX) {
                    yield $i;
                    return;
                }
                yield $i;
                $i++;
            }
        })();

        foreach ($generator as $num) {
            $this->assertTrue(Integer::isSmallIntUnsigned($num));
            $this->assertTrue(Integer::isSmallIntUnsigned(\strval($num)));
        }
    }

    function testFalse()
    {
        $this->assertFalse(Integer::isSmallIntUnsigned(\strval(Integer::SMALL_INT_UNSIGNED_MIN - 1)));
        $this->assertFalse(Integer::isSmallIntUnsigned(\strval(Integer::SMALL_INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isSmallIntUnsigned((Integer::SMALL_INT_UNSIGNED_MIN - 1)));
        $this->assertFalse(Integer::isSmallIntUnsigned((Integer::SMALL_INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isSmallIntUnsigned((Integer::SMALL_INT_UNSIGNED_MAX + 1)));
        $this->assertFalse(Integer::isSmallIntUnsigned((Integer::SMALL_INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isSmallIntUnsigned(\strval(Integer::SMALL_INT_UNSIGNED_MAX + 1)));
        $this->assertFalse(Integer::isSmallIntUnsigned(\strval(Integer::SMALL_INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isSmallIntUnsigned(\PHP_INT_MAX));
        $this->assertFalse(Integer::isSmallIntUnsigned(\PHP_INT_MIN));

        $this->assertFalse(Integer::isSmallIntUnsigned(\strval(\PHP_INT_MAX)));
        $this->assertFalse(Integer::isSmallIntUnsigned(\strval(\PHP_INT_MIN)));
    }
}
