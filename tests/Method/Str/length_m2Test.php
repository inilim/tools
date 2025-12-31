<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class length_m2Test extends TestCase
{
    function test()
    {
        $str = 'foo bar baz';
        $this->assertEquals(\mb_strlen($str, 'UTF-8'), Str::length_m2($str));
        $str = 'foo bar' . "\n" . 'baz';
        $this->assertEquals(\mb_strlen($str, 'UTF-8'), Str::length_m2($str));
        $str = 'こんにちは';
        $this->assertEquals(\mb_strlen($str, 'UTF-8'), Str::length_m2($str));
        $str = 'こん' . "\n" . 'にちは';
        $this->assertEquals(\mb_strlen($str, 'UTF-8'), Str::length_m2($str));
    }
}
