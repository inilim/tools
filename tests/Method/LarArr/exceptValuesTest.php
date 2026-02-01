<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;

class exceptValuesTest extends TestCase
{
    function test(): void
    {
        $array = ['name' => 'taylor', 'age' => 26, 'city' => 'austin'];
        $this->assertEquals(['name' => 'taylor', 'city' => 'austin'], LarArr::exceptValues($array, [26]));
        $this->assertEquals(['name' => 'taylor', 'city' => 'austin'], LarArr::exceptValues($array, 26));

        $array = ['foo', 'bar', 'baz', 'qux'];
        $this->assertEquals([1 => 'bar', 3 => 'qux'], LarArr::exceptValues($array, ['foo', 'baz']));
        $this->assertEquals([0 => 'foo', 1 => 'bar', 3 => 'qux'], LarArr::exceptValues($array, 'baz'));

        $array = [1, 2, 3, 4, 5];
        $this->assertEquals([0 => 1, 1 => 2, 4 => 5], LarArr::exceptValues($array, [3, 4]));

        $array = ['a' => 1, 'b' => 2, 'c' => 1, 'd' => 3];
        $this->assertEquals(['b' => 2, 'd' => 3], LarArr::exceptValues($array, 1));

        $this->assertEquals([], LarArr::exceptValues([], 'foo'));
        $this->assertEquals(['foo', 'bar'], LarArr::exceptValues(['foo', 'bar'], []));

        $array = [1, '1', 2, '2', 3];
        $this->assertEquals([1 => '1', 3 => '2'], LarArr::exceptValues($array, [1, 2, 3], true));
        $this->assertEquals([], LarArr::exceptValues($array, [1, 2, 3]));

        $array = ['a' => true, 'b' => false, 'c' => 1, 'd' => 0];
        $this->assertEquals(['a' => true, 'b' => false], LarArr::exceptValues($array, [1, 0], true));
        $this->assertEquals([], LarArr::exceptValues($array, [1, 0]));
    }
}
