<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isMediumIntTest extends TestCase
{
    function testRange()
    {
        $generator = (static function () {
            for ($i = 0; $i <= 10_000; $i++) {
                yield \mt_rand(Integer::MEDIUM_INT_MIN, Integer::MEDIUM_INT_MAX);
            }
        })();

        foreach ($generator as $num) {
            $this->assertTrue(Integer::isMediumInt($num));
            $this->assertTrue(Integer::isMediumInt(\strval($num)));
        }
    }

    function testFalse()
    {
        $this->assertFalse(Integer::isMediumInt(\strval(Integer::MEDIUM_INT_MIN - 1)));
        $this->assertFalse(Integer::isMediumInt(\strval(Integer::MEDIUM_INT_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isMediumInt((Integer::MEDIUM_INT_MIN - 1)));
        $this->assertFalse(Integer::isMediumInt((Integer::MEDIUM_INT_MIN - \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isMediumInt((Integer::MEDIUM_INT_MAX + 1)));
        $this->assertFalse(Integer::isMediumInt((Integer::MEDIUM_INT_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isMediumInt(\strval(Integer::MEDIUM_INT_MAX + 1)));
        $this->assertFalse(Integer::isMediumInt(\strval(Integer::MEDIUM_INT_MAX + \mt_rand(1, \PHP_INT_MAX))));

        $this->assertFalse(Integer::isMediumInt(\PHP_INT_MAX));
        $this->assertFalse(Integer::isMediumInt(\PHP_INT_MIN));

        $this->assertFalse(Integer::isMediumInt(\strval(\PHP_INT_MAX)));
        $this->assertFalse(Integer::isMediumInt(\strval(\PHP_INT_MIN)));
    }
}
