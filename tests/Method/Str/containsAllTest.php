<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class containsAllTest extends TestCase
{
    #[DataProvider('data')]
    function test($haystack, $needles, $expected, $ignoreCase = false)
    {
        $this->assertEquals($expected, Str::containsAll($haystack, $needles, $ignoreCase));
    }

    static function data()
    {
        return [
            ['Hello World', ['hello', 'world'], false, false],
            ['Hello World', ['hello', 'world'], true, true],
            ['Hello World', ['hello'], false, false],
            ['Hello World', ['hello'], true, true],
            ['Hello World', ['hello', 'xxx'], false, false],
            ['Hello World', ['hello', 'xxx'], false, true],
        ];
    }
}
