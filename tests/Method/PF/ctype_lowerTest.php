<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_lowerTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidLowers
     */
    function testValidCtypeLower($text)
    {
        $this->assertTrue(PF::ctype_lower($text));
    }

    static function provideValidLowers()
    {
        return [
            [98],
            ['asdf'],
            ['stuff'],
        ];
    }

    /**
     * @dataProvider provideInvalidLower
     */
    function testInvalidCtypeLower($text)
    {
        $this->assertFalse(PF::ctype_lower($text));
    }

    static function provideInvalidLower()
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
            ['asd df'],
            ['ADD'],
            ['123'],
            ['A1cbad'],
            ['!!'],
            [''],
            ['é'],
            ["\n"],
            ["\x00asdf"],
        ];
    }
}
