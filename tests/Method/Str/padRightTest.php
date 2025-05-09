<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class padRightTest extends TestCase
{
    function test()
    {
        $this->assertSame('Alien-=-=-', Str::padRight('Alien', 10, '-='));
        $this->assertSame('Alien     ', Str::padRight('Alien', 10));
        $this->assertSame('❤MultiByte☆     ', Str::padRight('❤MultiByte☆', 16));
        $this->assertSame('❤MultiByte☆❤☆❤☆❤', Str::padRight('❤MultiByte☆', 16, '❤☆'));
    }
}
