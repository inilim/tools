<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class addTest extends TestCase
{
    function test()
    {
        $array = Arr::add(['name' => 'Desk'], 'price', 100);
        $this->assertEquals(['name' => 'Desk', 'price' => 100], $array);

        $this->assertEquals(['surname' => 'Mövsümov'], Arr::add([], 'surname', 'Mövsümov'));
        $this->assertEquals(['developer' => ['name' => 'Ferid']], Arr::add([], 'developer.name', 'Ferid'));
        $this->assertEquals([1 => 'hAz'], Arr::add([], 1, 'hAz'));
        // INFO почему тут float???
        $this->assertEquals([1 => [1 => 'hAz']], Arr::add([], 1.1, 'hAz'));

        // Case where the key already exists
        $this->assertEquals(['type' => 'Table'], Arr::add(['type' => 'Table'], 'type', 'Chair'));
        $this->assertEquals(['category' => ['type' => 'Table']], Arr::add(['category' => ['type' => 'Table']], 'category.type', 'Chair'));
    }
}
