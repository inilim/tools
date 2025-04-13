<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class ltrimTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo    bar ', Str::ltrim(' foo    bar '));

        $this->assertSame('123    ', Str::ltrim('   123    '));
        $this->assertSame('だ', Str::ltrim('だ'));
        $this->assertSame('ム', Str::ltrim('ム'));
        $this->assertSame('だ    ', Str::ltrim('   だ    '));
        $this->assertSame('ム    ', Str::ltrim('   ム    '));

        $this->assertSame(
            'foo bar
            ',
            Str::ltrim('
                foo bar
            ')
        );
        $this->assertSame("\xE9 ", Str::ltrim(" \xE9 "));

        $ltrimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($ltrimDefaultChars as $char) {
            $this->assertSame('', Str::ltrim(" {$char} "));
            $this->assertSame(ltrim(" {$char} "), Str::ltrim(" {$char} "));

            $this->assertSame("foo bar {$char}", Str::ltrim("{$char} foo bar {$char}"));
            $this->assertSame(ltrim("{$char} foo bar {$char}"), Str::ltrim("{$char} foo bar {$char}"));
        }
    }
}
