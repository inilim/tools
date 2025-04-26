<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_spaceTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidSpaces
     */
    function testValidCtypeSpace($text)
    {
        $this->assertTrue(PF::ctype_space($text));
    }

    static function provideValidSpaces()
    {
        return [
            [32],
            ["\t"],
            ["\n"],
            ["\r\n"],
            ["\n\r"],
            ["\r"],
        ];
    }

    /**
     * @dataProvider provideInvalidSpace
     */
    function testInvalidCtypeSpace($text)
    {
        $this->assertFalse(PF::ctype_space($text));
    }

    static function provideInvalidSpace()
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
            [8],
            [65],
            [98],
            [43],
            [127],
            [280],
            ['asdf'],
            ['123'],
            ["\x01"],
            [''],
            ['Ad12'],
            ['ADD'],
        ];
    }
}
