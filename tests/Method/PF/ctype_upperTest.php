<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_upperTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidUppers
     */
    function testValidCtypeUpper($text)
    {
        $this->assertTrue(PF::ctype_upper($text));
    }

    static function provideValidUppers()
    {
        return [
            [65],
            ['ADD'],
            ['ASDF'],
            ['DDD'],
        ];
    }

    /**
     * @dataProvider provideInvalidUpper
     */
    function testInvalidCtypeUpper($text)
    {
        $this->assertFalse(PF::ctype_upper($text));
    }

    static function provideInvalidUpper()
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
            [43],
            [53],
            [98],
            [127],
            [280],
            [-129],
            [-128],
            ['asdf'],
            ['123'],
            ["\x01"],
            [''],
            ['Ad12'],
            ["\t"],
            ["\n"],
            ["\r\n"],
            ["\n\r"],
            ["\r"],
        ];
    }
}
