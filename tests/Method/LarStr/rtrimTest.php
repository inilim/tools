<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class rtrimTest extends TestCase
{
    function test()
    {
        $this->assertSame(' foo    bar', LarStr::rtrim(' foo    bar '));

        $this->assertSame('   123', LarStr::rtrim('   123    '));
        $this->assertSame('だ', LarStr::rtrim('だ'));
        $this->assertSame('ム', LarStr::rtrim('ム'));
        $this->assertSame('   だ', LarStr::rtrim('   だ    '));
        $this->assertSame('   ム', LarStr::rtrim('   ム    '));

        $this->assertSame(
            '
                foo bar',
            LarStr::rtrim('
                foo bar
            ')
        );

        $this->assertSame(" \xE9", LarStr::rtrim(" \xE9 "));

        $rtrimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($rtrimDefaultChars as $char) {
            $this->assertSame('', LarStr::rtrim(" {$char} "));
            $this->assertSame(rtrim(" {$char} "), LarStr::rtrim(" {$char} "));

            $this->assertSame("{$char} foo bar", LarStr::rtrim("{$char} foo bar {$char}"));
            $this->assertSame(rtrim("{$char} foo bar {$char}"), LarStr::rtrim("{$char} foo bar {$char}"));
        }
    }
}
