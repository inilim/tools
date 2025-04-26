<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_digitTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidDigits
     */
    function testValidCtypeDigit($text)
    {
        $this->assertTrue(PF::ctype_digit($text));
    }

    static function provideValidDigits()
    {
        return [
            ['0'],
            [53],
            [280],
            ['123'],
            ['01234'],
            ['934'],
        ];
    }

    /**
     * @dataProvider provideInvalidDigit
     */
    function testInvalidCtypeDigit($text)
    {
        $this->assertFalse(PF::ctype_digit($text));
    }

    static function provideInvalidDigit()
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
            [65],
            [98],
            [-129],
            [-456],
            ['asd df'],
            [''],
            ['é'],
            ['1234B'],
            ['13addfadsf2'],
            ["\x00a"],
            [\chr(127), '-3', '3.5'],
        ];
    }
}
