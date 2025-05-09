<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_alnumTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidAlnums
     */
    function testValidCtypeAlnum($text)
    {
        $this->assertTrue(PF::ctype_alnum($text));
    }

    static function provideValidAlnums()
    {
        return [
            ['0'],
            [53],
            [65],
            [98],
            [-127],
            ['asdf'],
            ['ADD'],
            ['123'],
            ['A1cbad'],
            [280],
        ];
    }

    /**
     * @dataProvider provideInvalidAlnum
     */
    function testInvalidCtypeAlnum($text)
    {
        $this->assertFalse(PF::ctype_alnum($text));
    }

    static function provideInvalidAlnum()
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
            ['asd df'],
            ['é'],
            [''],
            ['!!'],
            ['!asdf'],
            ['as2!a'],
            ["\x00asdf"],
        ];
    }
}
