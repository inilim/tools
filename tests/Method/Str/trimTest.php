<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class trimTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo bar', Str::trim('   foo bar   '));
        $this->assertSame('foo bar', Str::trim('foo bar   '));
        $this->assertSame('foo bar', Str::trim('   foo bar'));
        $this->assertSame('foo bar', Str::trim('foo bar'));
        $this->assertSame(' foo bar ', Str::trim(' foo bar ', ''));
        $this->assertSame('foo bar', Str::trim(' foo bar ', ' '));
        $this->assertSame('foo  bar', Str::trim('-foo  bar_', '-_'));

        $this->assertSame('foo    bar', Str::trim(' foo    bar '));

        $this->assertSame('123', Str::trim('   123    '));
        $this->assertSame('だ', Str::trim('だ'));
        $this->assertSame('ム', Str::trim('ム'));
        $this->assertSame('だ', Str::trim('   だ    '));
        $this->assertSame('ム', Str::trim('   ム    '));

        $this->assertSame(
            'foo bar',
            Str::trim('
                foo bar
            ')
        );
        $this->assertSame(
            'foo
                bar',
            Str::trim('
                foo
                bar
            ')
        );

        $this->assertSame("\xE9", Str::trim(" \xE9 "));

        $trimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($trimDefaultChars as $char) {
            $this->assertSame('', Str::trim(" {$char} "));
            $this->assertSame(trim(" {$char} "), Str::trim(" {$char} "));

            $this->assertSame('foo bar', Str::trim("{$char} foo bar {$char}"));
            $this->assertSame(trim("{$char} foo bar {$char}"), Str::trim("{$char} foo bar {$char}"));
        }
    }
}
