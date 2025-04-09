<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class containsTest extends TestCase
{
    /**
     * @dataProvider data
     */
    function test($haystack, $needles, $expected, $ignoreCase = false)
    {
        $this->assertEquals($expected, Str::contains($haystack, $needles, $ignoreCase));
    }

    static function data()
    {
        return [
            ['Hello', 'ylo', true, true],
            ['Hello', 'ylo', true, false],
            ['Hello', 'hello', true, true],
            ['Hello', 'hello', false, false],
            ['Hello', ['ylo'], true, true],
            ['Hello', ['ylo'], true, false],
            ['Hello', ['xxx', 'ylo'], true, true],
            // ['Hello', collect(['xxx', 'ylo']), true, true],
            ['Hello', ['xxx', 'ylo'], true, false],
            ['Hello', 'xxx', false],
            ['Hello', ['xxx'], false],
            ['Hello', '', false],
            ['', '', false],
        ];
    }
}
