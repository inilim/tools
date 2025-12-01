<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;

class mapSpreadTest extends TestCase
{
    public function testMapSpread()
    {
        $c = [[1, 'a'], [2, 'b']];

        $result = LarArr::mapSpread($c, function ($number, $character) {
            return "{$number}-{$character}";
        });
        $this->assertEquals(['1-a', '2-b'], $result);

        $result = LarArr::mapSpread($c, function ($number, $character, $key) {
            return "{$number}-{$character}-{$key}";
        });
        $this->assertEquals(['1-a-0', '2-b-1'], $result);
    }
}

