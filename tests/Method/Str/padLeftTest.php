<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class padLeftTest extends TestCase
{
    function test()
    {
        $this->assertSame('-=-=-Alien', Str::padLeft('Alien', 10, '-='));
        $this->assertSame('     Alien', Str::padLeft('Alien', 10));
        $this->assertSame('     ❤MultiByte☆', Str::padLeft('❤MultiByte☆', 16));
        $this->assertSame('❤☆❤☆❤❤MultiByte☆', Str::padLeft('❤MultiByte☆', 16, '❤☆'));
    }
}
