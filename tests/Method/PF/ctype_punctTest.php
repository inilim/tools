<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_punctTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidPuncts
     */
    function testValidCtypePunct($text)
    {
        $this->assertTrue(PF::ctype_punct($text));
    }

    static function provideValidPuncts()
    {
        return [
            [43],
            ['!!'],
            ['@@!#^$'],
        ];
    }

    /**
     * @dataProvider provideInvalidPunct
     */
    function testInvalidCtypePunct($text)
    {
        $this->assertFalse(PF::ctype_punct($text));
    }

    static function provideInvalidPunct()
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
            [53],
            [65],
            [98],
            [127],
            ['é'],
            ['asd df'],
            ['ADD'],
            ['123'],
            ['A1cbad'],
            [''],
            ["\n"],
            ["\x00asdf"],
        ];
    }
}
