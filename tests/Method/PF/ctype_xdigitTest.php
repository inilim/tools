<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_xdigitTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidXdigits
     */
    function testValidCtypeXdigit($text)
    {
        $this->assertTrue(PF::ctype_xdigit($text));
    }

    static function provideValidXdigits()
    {
        return [
            ['0'],
            [53],
            [65],
            [98],
            [70],
            [102],
            [280],
            ['01234'],
            ['a0123'],
            ['A4fD'],
            ['DDD'],
            ['bbb'],
        ];
    }

    /**
     * @dataProvider provideInvalidXdigit
     */
    function testInvalidCtypeXdigit($text)
    {
        $this->assertFalse(PF::ctype_xdigit($text));
    }

    static function provideInvalidXdigit()
    {
        return [
            [[]],
            [true],
            [null],
            [new \stdClass()],
            [53.0],
            [25.4],
            [-129],
            [-386],
            [43],
            [71],
            [103],
            [127],
            ['asdfk'],
            ['hhh'],
            ['0123kl'],
            ['zzz'],
            ["\x01"],
            [''],
            ["\t"],
            ["\n"],
            ["\r\n"],
            ["\n\r"],
            ["\r"],
        ];
    }
}
