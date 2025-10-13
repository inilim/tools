<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isTinyIntUnsignedTest extends TestCase
{
    /**
     * @dataProvider dataRange
     */
    function testRange(int $num)
    {
        $this->assertTrue(Integer::isTinyIntUnsigned($num));
        $this->assertTrue(Integer::isTinyIntUnsigned(\strval($num)));
    }

    function test()
    {
        $this->assertFalse(Integer::isTinyIntUnsigned((Integer::TINY_INT_UNSIGNED_MIN - 1)));
        $this->assertFalse(Integer::isTinyIntUnsigned((Integer::TINY_INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyIntUnsigned(-9812738));
        $this->assertFalse(Integer::isTinyIntUnsigned((Integer::TINY_INT_UNSIGNED_MAX + 1)));
        $this->assertFalse(Integer::isTinyIntUnsigned((Integer::TINY_INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyIntUnsigned(9812738));
        $this->assertFalse(Integer::isTinyIntUnsigned(\PHP_INT_MAX));
        $this->assertFalse(Integer::isTinyIntUnsigned(\PHP_INT_MIN));

        $this->assertFalse(Integer::isTinyIntUnsigned(\strval(Integer::TINY_INT_UNSIGNED_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyIntUnsigned(\strval(Integer::TINY_INT_UNSIGNED_MIN - 1)));
        $this->assertFalse(Integer::isTinyIntUnsigned(\strval(Integer::TINY_INT_UNSIGNED_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyIntUnsigned(\strval(Integer::TINY_INT_UNSIGNED_MAX + 1)));
        $this->assertFalse(Integer::isTinyIntUnsigned('9812738'));
        $this->assertFalse(Integer::isTinyIntUnsigned('-9812738'));
        $this->assertFalse(Integer::isTinyIntUnsigned(\strval(\PHP_INT_MAX)));
        $this->assertFalse(Integer::isTinyIntUnsigned(\strval(\PHP_INT_MIN)));
    }

    static function dataRange()
    {
        $i = Integer::TINY_INT_UNSIGNED_MIN;
        while (true) {
            if ($i >= Integer::TINY_INT_UNSIGNED_MAX) {
                yield [$i];
                return;
            }
            yield [$i];
            $i++;
        }
    }
}
