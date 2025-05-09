<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class swapTest extends TestCase
{
    function test()
    {
        $this->assertSame(
            'PHP 8 is fantastic',
            Str::swap([
                'PHP' => 'PHP 8',
                'awesome' => 'fantastic',
            ], 'PHP is awesome')
        );

        $this->assertSame(
            'foo bar baz',
            Str::swap([
                'ⓐⓑ' => 'baz',
            ], 'foo bar ⓐⓑ')
        );
    }
}
