<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_printTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidPrints
     */
    function testValidCtypePrint($text)
    {
        $this->assertTrue(PF::ctype_print($text));
    }

    static function provideValidPrints()
    {
        return [
            [-129],
            [-386],
            ['0'],
            [43],
            [53],
            [280],
            [65],
            [98],
            ['567'],
            ['!!'],
            ['@@!#^$'],
            ['asd df'],
        ];
    }

    /**
     * @dataProvider provideInvalidPrint
     */
    function testInvalidCtypePrint($text)
    {
        $this->assertFalse(PF::ctype_print($text));
    }

    static function provideInvalidPrint()
    {
        return [
            [[]],
            [true],
            [null],
            [new \stdClass()],
            [53.0],
            [25.4],
            [8],
            [127],
            ['é'],
            ["\n"],
            ["\x00asdf"],
        ];
    }
}
