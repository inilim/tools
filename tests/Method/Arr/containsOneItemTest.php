<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;

class containsOneItemTest extends TestCase
{
    function test()
    {
        $this->assertFalse(Arr::containsOneItem([1, 2, 2], fn($number) => $number === 2));
        $this->assertTrue(Arr::containsOneItem(['ant', 'bear', 'cat'], fn($word) => strlen($word) === 4));
        $this->assertFalse(Arr::containsOneItem(['ant', 'bear', 'cat'], fn($word) => strlen($word) > 4));
    }
}
