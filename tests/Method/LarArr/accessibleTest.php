<?php

namespace Inilim\Tool\Test\Method\LarArr;

use Inilim\Tool\LarArr;
use Inilim\Tool\Test\TestCase;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

class accessibleTest extends TestCase
{
    public function testAccessible(): void
    {
        $this->assertTrue(LarArr::accessible([]));
        $this->assertTrue(LarArr::accessible([1, 2]));
        $this->assertTrue(LarArr::accessible(['a' => 1, 'b' => 2]));
        $this->assertTrue(LarArr::accessible(new ClassArrayAccessIteratorAggregate));

        $this->assertFalse(LarArr::accessible(null));
        $this->assertFalse(LarArr::accessible('abc'));
        $this->assertFalse(LarArr::accessible(new \stdClass));
        $this->assertFalse(LarArr::accessible((object) ['a' => 1, 'b' => 2]));
        $this->assertFalse(LarArr::accessible(123));
        $this->assertFalse(LarArr::accessible(12.34));
        $this->assertFalse(LarArr::accessible(true));
        $this->assertFalse(LarArr::accessible(new \DateTime));
        $this->assertFalse(LarArr::accessible(static fn() => null));
    }
}
