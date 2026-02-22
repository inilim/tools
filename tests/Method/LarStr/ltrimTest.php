<?php

namespace Inilim\Tool\Test\Method\LarStr;

use Inilim\Tool\LarStr;
use Inilim\Tool\Test\TestCase;

class ltrimTest extends TestCase
{
    function test()
    {
        $this->assertSame('foo    bar ', LarStr::ltrim(' foo    bar '));

        $this->assertSame('123    ', LarStr::ltrim('   123    '));
        $this->assertSame('だ', LarStr::ltrim('だ'));
        $this->assertSame('ム', LarStr::ltrim('ム'));
        $this->assertSame('だ    ', LarStr::ltrim('   だ    '));
        $this->assertSame('ム    ', LarStr::ltrim('   ム    '));

        $this->assertSame(
            'foo bar
            ',
            LarStr::ltrim('
                foo bar
            ')
        );
        $this->assertSame("\xE9 ", LarStr::ltrim(" \xE9 "));

        $ltrimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($ltrimDefaultChars as $char) {
            $this->assertSame('', LarStr::ltrim(" {$char} "));
            $this->assertSame(ltrim(" {$char} "), LarStr::ltrim(" {$char} "));

            $this->assertSame("foo bar {$char}", LarStr::ltrim("{$char} foo bar {$char}"));
            $this->assertSame(ltrim("{$char} foo bar {$char}"), LarStr::ltrim("{$char} foo bar {$char}"));
        }
    }
}
