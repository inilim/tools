<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class array_firstTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        $this->assertNull(PF::array_first([]));

        $array = [1, 2, 3];
        unset($array[0], $array[1], $array[2]);

        $this->assertNull(PF::array_first($array));

        $this->assertSame("single element", PF::array_first(["single element"]));

        $str = "hello world";
        $this->assertSame($str, PF::array_first([&$str, 1]));

        $this->assertSame(1, PF::array_first([1, &$str]));

        $this->assertSame(1, PF::array_first([1 => 1, 0 => 0, 3 => 3, 2 => 2]));

        $this->assertSame([], PF::array_first([100 => []]));

        $this->assertEquals(new \stdClass(), PF::array_first([new \stdClass, false]));

        $this->assertTrue(PF::array_first([true, new \stdClass]));
    }
}
