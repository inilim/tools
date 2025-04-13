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
            ['Taylor', 'ylo', true, true],
            ['Taylor', 'ylo', true, false],
            ['Taylor', 'taylor', true, true],
            ['Taylor', 'taylor', false, false],
            ['Taylor', ['ylo'], true, true],
            ['Taylor', ['ylo'], true, false],
            ['Taylor', ['xxx', 'ylo'], true, true],
            // ['Taylor', collect(['xxx', 'ylo']), true, true],
            ['Taylor', ['xxx', 'ylo'], true, false],
            ['Taylor', 'xxx', false],
            ['Taylor', ['xxx'], false],
            ['Taylor', '', false],
            ['', '', false],
        ];
    }
}
