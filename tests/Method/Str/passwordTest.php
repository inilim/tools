<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class passwordTest extends TestCase
{
    function test()
    {
        $this->assertTrue(strlen(Str::password()) === 32);

        $this->assertStringNotContainsString(' ', Str::password());
        $this->assertStringContainsString(' ', Str::password(32, true, true, true, true));

        $this->assertTrue(
            Str::contains(Str::password(), ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'])
        );
    }
}
