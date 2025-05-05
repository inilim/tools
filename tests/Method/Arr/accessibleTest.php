<?php

namespace Inilim\Tool\Test\Method\Arr;

use Inilim\Tool\Arr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class accessibleTest extends TestCase
{
    function test()
    {
        $this->assertTrue(Arr::accessible([]));
        $this->assertTrue(Arr::accessible([1, 2]));
        $this->assertTrue(Arr::accessible(['a' => 1, 'b' => 2]));
        $this->assertTrue(Arr::accessible(new ClassArrayAccessIteratorAggregate));

        $this->assertFalse(Arr::accessible(null));
        $this->assertFalse(Arr::accessible('abc'));
        $this->assertFalse(Arr::accessible(new \stdClass));
        $this->assertFalse(Arr::accessible((object) ['a' => 1, 'b' => 2]));
        $this->assertFalse(Arr::accessible(123));
        $this->assertFalse(Arr::accessible(12.34));
        $this->assertFalse(Arr::accessible(true));
        $this->assertFalse(Arr::accessible(new \DateTime));
        $this->assertFalse(Arr::accessible(static fn() => null));
    }
}
