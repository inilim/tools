<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class charAtTest extends TestCase
{
    function test()
    {
        $this->assertEquals('р', Str::charAt('Привет, мир!', 1));
        $this->assertEquals('ち', Str::charAt('「こんにちは世界」', 4));
        $this->assertEquals('w', Str::charAt('Привет, world!', 8));
        $this->assertEquals('界', Str::charAt('「こんにちは世界」', -2));
        $this->assertEquals(null, Str::charAt('「こんにちは世界」', -200));
        $this->assertEquals(null, Str::charAt('Привет, мир!', 100));
    }
}
