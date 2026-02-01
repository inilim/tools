<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;

class onlyValuesTest extends TestCase
{
    function test(): void
    {
        $array = ['name' => 'taylor', 'age' => 26, 'city' => 'austin'];
        $this->assertEquals(['age' => 26], LarArr::onlyValues($array, [26]));
        $this->assertEquals(['age' => 26], LarArr::onlyValues($array, 26));

        $array = ['foo', 'bar', 'baz', 'qux'];
        $this->assertEquals([0 => 'foo', 2 => 'baz'], LarArr::onlyValues($array, ['foo', 'baz']));
        $this->assertEquals([2 => 'baz'], LarArr::onlyValues($array, 'baz'));

        $array = [1, 2, 3, 4, 5];
        $this->assertEquals([2 => 3, 3 => 4], LarArr::onlyValues($array, [3, 4]));

        $array = ['a' => 1, 'b' => 2, 'c' => 1, 'd' => 3];
        $this->assertEquals(['a' => 1, 'c' => 1], LarArr::onlyValues($array, 1));

        $this->assertEquals([], LarArr::onlyValues([], 'foo'));
        $this->assertEquals([], LarArr::onlyValues(['foo', 'bar'], []));

        $array = [1, '1', 2, '2', 3];
        $this->assertEquals([0 => 1, 2 => 2, 4 => 3], LarArr::onlyValues($array, [1, 2, 3], true));
        $this->assertEquals([0 => 1, 1 => '1', 2 => 2, 3 => '2', 4 => 3], LarArr::onlyValues($array, [1, 2, 3]));

        $array = ['a' => true, 'b' => false, 'c' => 1, 'd' => 0];
        $this->assertEquals(['c' => 1, 'd' => 0], LarArr::onlyValues($array, [1, 0], true));
        $this->assertEquals(['a' => true, 'b' => false, 'c' => 1, 'd' => 0], LarArr::onlyValues($array, [1, 0]));
    }
}
