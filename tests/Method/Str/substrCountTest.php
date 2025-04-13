<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class substrCountTest extends TestCase
{
    function test()
    {
        $this->assertSame(3, Str::substrCount('laravelPHPFramework', 'a'));
        $this->assertSame(0, Str::substrCount('laravelPHPFramework', 'z'));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'l', 2));
        $this->assertSame(0, Str::substrCount('laravelPHPFramework', 'z', 2));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'k', -1));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'k', -1));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'a', 1, 2));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'a', 1, 2));
        $this->assertSame(3, Str::substrCount('laravelPHPFramework', 'a', 1, -2));
        $this->assertSame(1, Str::substrCount('laravelPHPFramework', 'a', -10, -3));
    }
}
