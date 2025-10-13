<?php

namespace Inilim\Tool\Test\Method\Lar;

use Inilim\Tool\Lar;
use Inilim\Tool\Test\TestCase;

class valueTest extends TestCase
{
    public function testValue()
    {
        $callable = new class
        {
            public function __call($method, $arguments)
            {
                return $arguments;
            }
        };

        $this->assertSame($callable, Lar::value($callable, 'foo'));
        $this->assertSame('foo', Lar::value('foo'));
        $this->assertSame('foo', Lar::value(function () {
            return 'foo';
        }));
        $this->assertSame('foo', Lar::value(function ($arg) {
            return $arg;
        }, 'foo'));
    }
}
