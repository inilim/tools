<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_alphaTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidAlphas
     */
    function testValidCtypeAlpha($text)
    {
        $this->assertTrue(PF::ctype_alpha($text));
    }

    static function provideValidAlphas()
    {
        return [
            [65],
            [98],
            ['asdf'],
            ['ADD'],
            ['bAcbad'],
        ];
    }

    /**
     * @dataProvider provideInvalidAlpha
     */
    function testInvalidCtypeAlpha($text)
    {
        $this->assertFalse(PF::ctype_alpha($text));
    }

    static function provideInvalidAlpha()
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
            ['asd df'],
            [''],
            ['é'],
            ['1234'],
            ['13addfadsf2'],
            ["\x00asd"],
            [280],
        ];
    }
}
