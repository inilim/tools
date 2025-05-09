<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;
use Inilim\Tool\Test\ForTest\ClassStringable;

class prependTest extends TestCase
{
    function test()
    {
        $array = Arr::prepend(['one', 'two', 'three', 'four'], 'zero');
        $this->assertEquals(['zero', 'one', 'two', 'three', 'four'], $array);

        $array = Arr::prepend(['one' => 1, 'two' => 2], 0, 'zero');
        $this->assertEquals(['zero' => 0, 'one' => 1, 'two' => 2], $array);

        $array = Arr::prepend(['one' => 1, 'two' => 2], 0, null);
        $this->assertEquals([null => 0, 'one' => 1, 'two' => 2], $array);

        $array = Arr::prepend(['one', 'two'], null, '');
        $this->assertEquals(['' => null, 'one', 'two'], $array);

        $array = Arr::prepend([], 'zero');
        $this->assertEquals(['zero'], $array);

        $array = Arr::prepend([''], 'zero');
        $this->assertEquals(['zero', ''], $array);

        $array = Arr::prepend(['one', 'two'], ['zero']);
        $this->assertEquals([['zero'], 'one', 'two'], $array);

        $array = Arr::prepend(['one', 'two'], ['zero'], 'key');
        $this->assertEquals(['key' => ['zero'], 'one', 'two'], $array);
    }
}
