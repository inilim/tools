<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class beforeTest extends TestCase
{
    function test()
    {
        $this->assertSame('han', Str::before('hannah', 'nah'));
        $this->assertSame('ha', Str::before('hannah', 'n'));
        $this->assertSame('ééé ', Str::before('ééé hannah', 'han'));
        $this->assertSame('hannah', Str::before('hannah', 'xxxx'));
        $this->assertSame('hannah', Str::before('hannah', ''));
        $this->assertSame('han', Str::before('han0nah', '0'));
        $this->assertSame('han', Str::before('han0nah', 0));
        $this->assertSame('han', Str::before('han2nah', 2));
        $this->assertSame('', Str::before('', ''));
        $this->assertSame('', Str::before('', 'a'));
        $this->assertSame('', Str::before('a', 'a'));
        $this->assertSame('foo', Str::before('foo@bar.com', '@'));
        $this->assertSame('foo', Str::before('foo@@bar.com', '@'));
        $this->assertSame('', Str::before('@foo@bar.com', '@'));
    }
}
