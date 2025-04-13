<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class numbersTest extends TestCase
{
    function test()
    {
        $this->assertSame('5551234567', Str::numbers('(555) 123-4567'));
        $this->assertSame('443', Str::numbers('L4r4v3l!'));
        $this->assertSame('', Str::numbers('Explosion!'));

        $arrayValue = ['(555) 123-4567', 'L4r4v3l', 'Explosion!'];
        $arrayExpected = ['5551234567', '443', ''];
        $this->assertSame($arrayExpected, Str::numbers($arrayValue));
    }
}
