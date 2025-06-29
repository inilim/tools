<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class insertBetweenSubstrAfterMergeTest extends TestCase
{
    /**
     * @dataProvider data
     */
    function test($expected, $string, $parts, $separator)
    {
        $this->assertSame($expected, Str::insertBetweenSubstrAfterMerge($string, $parts, $separator));
    }

    static function data()
    {
        $string = '1234567890';
        return [
            // "/"
            ['67890/12345/12345/67890', $string, [-5, -5, -5, 5, 5, 5], '/'],
            ['90/78/56/34/12', $string, [-2, -2, -2, -2, -2], '/'],
            ['12/34/56/78/90', $string, [2, 2, 2, 2, 2], '/'],
            ['12345/67890', $string, [5, 5, 5], '/'],
            ['67890/12345', $string, [-5, -5, -5], '/'],
            ['12345/67890', $string, [5, -5], '/'],
            ['67890/12345', $string, [-5, -5], '/'],
            ['67890/12345', $string, [-5, 5], '/'],
            ['12345/#/67890', $string, [5, '#', 5], '/'],
            ['67890/#/12345', $string, [-5, '#', -5], '/'],
            [$string . '/#/' . $string, $string, [10, '#', -10], '/'],
            [$string . '/#/' . $string, $string, [$string, '#', -10], '/'],
            [$string . '/#/' . $string, $string, [10, '#', $string], '/'],
            // "--"
            ['90--78--56--34--12', $string, [-2, -2, -2, -2, -2], '--'],
            ['12--34--56--78--90', $string, [2, 2, 2, 2, 2], '--'],
            ['12345--67890', $string, [5, 5, 5], '--'],
            ['67890--12345', $string, [-5, -5, -5], '--'],
            ['12345--67890', $string, [5, -5], '--'],
            ['67890--12345', $string, [-5, -5], '--'],
            ['67890--12345', $string, [-5, 5], '--'],
            ['12345--#--67890', $string, [5, '#', 5], '--'],
            ['67890--#--12345', $string, [-5, '#', -5], '--'],
            [$string . '--#--' . $string, $string, [10, '#', -10], '--'],
            [$string . '--#--' . $string, $string, [$string, '#', -10], '--'],
            [$string . '--#--' . $string, $string, [10, '#', $string], '--'],
        ];
    }
}
