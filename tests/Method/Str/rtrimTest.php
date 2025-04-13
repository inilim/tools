<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class rtrimTest extends TestCase
{
    function test()
    {
        $this->assertSame(' foo    bar', Str::rtrim(' foo    bar '));

        $this->assertSame('   123', Str::rtrim('   123    '));
        $this->assertSame('だ', Str::rtrim('だ'));
        $this->assertSame('ム', Str::rtrim('ム'));
        $this->assertSame('   だ', Str::rtrim('   だ    '));
        $this->assertSame('   ム', Str::rtrim('   ム    '));

        $this->assertSame(
            '
                foo bar',
            Str::rtrim('
                foo bar
            ')
        );

        $this->assertSame(" \xE9", Str::rtrim(" \xE9 "));

        $rtrimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($rtrimDefaultChars as $char) {
            $this->assertSame('', Str::rtrim(" {$char} "));
            $this->assertSame(rtrim(" {$char} "), Str::rtrim(" {$char} "));

            $this->assertSame("{$char} foo bar", Str::rtrim("{$char} foo bar {$char}"));
            $this->assertSame(rtrim("{$char} foo bar {$char}"), Str::rtrim("{$char} foo bar {$char}"));
        }
    }
}
