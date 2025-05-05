<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class exceptTest extends TestCase
{
    function test()
    {
        $array = ['name' => 'taylor', 'age' => 26];
        $this->assertEquals(['age' => 26], Arr::except($array, ['name']));
        $this->assertEquals(['age' => 26], Arr::except($array, 'name'));

        $array = ['name' => 'taylor', 'framework' => ['language' => 'PHP', 'name' => 'Laravel']];
        $this->assertEquals(['name' => 'taylor'], Arr::except($array, 'framework'));
        $this->assertEquals(['name' => 'taylor', 'framework' => ['name' => 'Laravel']], Arr::except($array, 'framework.language'));
        $this->assertEquals(['framework' => ['language' => 'PHP']], Arr::except($array, ['name', 'framework.name']));

        $array = [1 => 'hAz', 2 => [5 => 'foo', 12 => 'baz']];
        $this->assertEquals([1 => 'hAz'], Arr::except($array, 2));
        $this->assertEquals([1 => 'hAz', 2 => [12 => 'baz']], Arr::except($array, 2.5));
    }
}
