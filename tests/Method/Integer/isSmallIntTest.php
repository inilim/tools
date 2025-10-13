<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isSmallIntTest extends TestCase
{
    function testRange()
    {
        $generator = (static function () {
            $i = Integer::SMALL_INT_MIN;
            while (true) {
                if ($i >= Integer::SMALL_INT_MAX) {
                    yield $i;
                    return;
                }
                yield $i;
                $i++;
            }
        })();

        foreach ($generator as $num) {
            $this->assertTrue(Integer::isSmallInt($num));
            $this->assertTrue(Integer::isSmallInt(\strval($num)));
        }
    }

    function testFalse()
    {
        $this->assertFalse(Integer::isSmallInt(\strval(Integer::SMALL_INT_MIN - 1)));
        $this->assertFalse(Integer::isSmallInt(\strval(Integer::SMALL_INT_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isSmallInt((Integer::SMALL_INT_MIN - 1)));
        $this->assertFalse(Integer::isSmallInt((Integer::SMALL_INT_MIN - \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isSmallInt((Integer::SMALL_INT_MAX + 1)));
        $this->assertFalse(Integer::isSmallInt((Integer::SMALL_INT_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isSmallInt(\strval(Integer::SMALL_INT_MAX + 1)));
        $this->assertFalse(Integer::isSmallInt(\strval(Integer::SMALL_INT_MAX + \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isTinyInt(\PHP_INT_MAX));
        $this->assertFalse(Integer::isTinyInt(\PHP_INT_MIN));

        $this->assertFalse(Integer::isTinyInt(\strval(\PHP_INT_MAX)));
        $this->assertFalse(Integer::isTinyInt(\strval(\PHP_INT_MIN)));
    }
}
