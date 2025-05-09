<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;
use Inilim\Tool\Test\ForTest\ClassStringable;

class mapSpreadTest extends TestCase
{
    function test()
    {
        $c = [[1, 'a'], [2, 'b']];

        $result = Arr::mapSpread($c, function ($number, $character) {
            return "{$number}-{$character}";
        });
        $this->assertEquals(['1-a', '2-b'], $result);

        $result = Arr::mapSpread($c, function ($number, $character, $key) {
            return "{$number}-{$character}-{$key}";
        });
        $this->assertEquals(['1-a-0', '2-b-1'], $result);
    }
}
