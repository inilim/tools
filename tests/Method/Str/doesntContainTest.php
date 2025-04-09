<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class doesntContainTest extends TestCase
{
    /**
     * @dataProvider data
     */
    function test($haystack, $needles, $expected, $ignoreCase = false)
    {
        $this->assertEquals($expected, Str::doesntContain($haystack, $needles, $ignoreCase));
    }

    static function data()
    {
        return [
            ['Tar', 'ylo', true, true],
        ];
    }
}
