<?php

namespace Inilim\Tool\Test\Method\Integer;

use Inilim\Tool\Integer;
use Inilim\Tool\Test\TestCase;

class isTinyIntTest extends TestCase
{
    /**
     * @dataProvider dataRange
     */
    function testRange(int $num)
    {
        $this->assertTrue(Integer::isTinyInt($num));
        $this->assertTrue(Integer::isTinyInt(\strval($num)));
    }

    function test()
    {
        $this->assertFalse(Integer::isTinyInt((Integer::TINY_INT_MIN - 1)));
        $this->assertFalse(Integer::isTinyInt((Integer::TINY_INT_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyInt(-9812738));
        $this->assertFalse(Integer::isTinyInt((Integer::TINY_INT_MAX + 1)));
        $this->assertFalse(Integer::isTinyInt((Integer::TINY_INT_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyInt(9812738));
        $this->assertFalse(Integer::isTinyInt(\PHP_INT_MAX));
        $this->assertFalse(Integer::isTinyInt(\PHP_INT_MIN));

        $this->assertFalse(Integer::isTinyInt(\strval(Integer::TINY_INT_MIN - \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyInt(\strval(Integer::TINY_INT_MIN - 1)));
        $this->assertFalse(Integer::isTinyInt(\strval(Integer::TINY_INT_MAX + \mt_rand(1, \PHP_INT_MAX))));
        $this->assertFalse(Integer::isTinyInt(\strval(Integer::TINY_INT_MAX + 1)));
        $this->assertFalse(Integer::isTinyInt('9812738'));
        $this->assertFalse(Integer::isTinyInt('-9812738'));
        $this->assertFalse(Integer::isTinyInt(\strval(\PHP_INT_MAX)));
        $this->assertFalse(Integer::isTinyInt(\strval(\PHP_INT_MIN)));
    }

    static function dataRange()
    {
        $i = Integer::TINY_INT_MIN;
        while (true) {
            if ($i >= Integer::TINY_INT_MAX) {
                yield [$i];
                return;
            }
            yield [$i];
            $i++;
        }
    }
}
