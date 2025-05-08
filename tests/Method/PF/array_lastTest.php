<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class array_lastTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        $this->assertNull(PF::array_last([]));

        $array = [1, 2, 3];
        unset($array[0], $array[1], $array[2]);

        $this->assertNull(PF::array_last($array));


        $this->assertSame("single element", PF::array_last(["single element"]));

        $str = "hello world";
        $this->assertSame(1, PF::array_last([&$str, 1]));

        $this->assertSame($str, PF::array_last([1, &$str]));

        $this->assertSame(2, PF::array_last([1 => 1, 0 => 0, 3 => 3, 2 => 2]));

        $this->assertSame([], PF::array_last([100 => []]));

        $this->assertFalse(PF::array_last([new \stdClass, false]));

        $this->assertEquals(new \stdClass(), PF::array_last([true, new \stdClass]));
    }
}
