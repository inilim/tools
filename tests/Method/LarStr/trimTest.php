<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class trimTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo bar', LarStr::trim('   foo bar   '));
        $this->assertSame('foo bar', LarStr::trim('foo bar   '));
        $this->assertSame('foo bar', LarStr::trim('   foo bar'));
        $this->assertSame('foo bar', LarStr::trim('foo bar'));
        $this->assertSame(' foo bar ', LarStr::trim(' foo bar ', ''));
        $this->assertSame('foo bar', LarStr::trim(' foo bar ', ' '));
        $this->assertSame('foo  bar', LarStr::trim('-foo  bar_', '-_'));

        $this->assertSame('foo    bar', LarStr::trim(' foo    bar '));

        $this->assertSame('123', LarStr::trim('   123    '));
        $this->assertSame('だ', LarStr::trim('だ'));
        $this->assertSame('ム', LarStr::trim('ム'));
        $this->assertSame('だ', LarStr::trim('   だ    '));
        $this->assertSame('ム', LarStr::trim('   ム    '));

        $this->assertSame(
            'foo bar',
            LarStr::trim('
                foo bar
            ')
        );
        $this->assertSame(
            'foo
                bar',
            LarStr::trim('
                foo
                bar
            ')
        );

        $this->assertSame("\xE9", LarStr::trim(" \xE9 "));

        $trimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($trimDefaultChars as $char) {
            $this->assertSame('', LarStr::trim(" {$char} "));
            $this->assertSame(trim(" {$char} "), LarStr::trim(" {$char} "));

            $this->assertSame('foo bar', LarStr::trim("{$char} foo bar {$char}"));
            $this->assertSame(trim("{$char} foo bar {$char}"), LarStr::trim("{$char} foo bar {$char}"));
        }
    }
}
