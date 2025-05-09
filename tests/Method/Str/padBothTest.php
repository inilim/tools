<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\Group;

class padBothTest extends TestCase
{
    function test()
    {
        $this->assertSame('__Alien___', Str::padBoth('Alien', 10, '_'));
        $this->assertSame('  Alien   ', Str::padBoth('Alien', 10));
        $this->assertSame('  ❤MultiByte☆   ', Str::padBoth('❤MultiByte☆', 16));
        $this->assertSame('❤☆❤MultiByte☆❤☆❤', Str::padBoth('❤MultiByte☆', 16, '❤☆'));
    }
}
