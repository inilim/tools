<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class reverseTest extends TestCase
{
    function test()
    {
        $this->assertSame('FooBar', Str::reverse('raBooF'));
        $this->assertSame('Teniszütő', Str::reverse('őtüzsineT'));
        $this->assertSame('❤MultiByte☆', Str::reverse('☆etyBitluM❤'));
        $this->assertSame('тевирп', Str::reverse('привет'));
    }
}
