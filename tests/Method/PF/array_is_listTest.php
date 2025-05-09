<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

class array_is_listTest extends \Inilim\Tool\Test\TestCase
{
    function test()
    {
        $this->assertTrue(PF::array_is_list([]));
        $this->assertTrue(PF::array_is_list([\NAN, 'foo', 123]));
        $this->assertFalse(PF::array_is_list([1 => 'a', 0 => 'b']));
        $this->assertFalse(PF::array_is_list(['a' => 'b']));
        $this->assertFalse(PF::array_is_list([0 => 'a', 2 => 'b']));
        $this->assertFalse(PF::array_is_list([1 => 'a', 2 => 'b']));

        $x = ['key' => 2, \NAN];
        unset($x['key']);
        $this->assertTrue(PF::array_is_list($x));
    }
}
