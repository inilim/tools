<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_cntrlTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidCntrls
     */
    function testValidCtypeCntrl($text)
    {
        $this->assertTrue(PF::ctype_cntrl($text));
    }

    static function provideValidCntrls()
    {
        return [
            [8],
            [127],
            ["\x00"],
            ["\x02"],
            [\chr(127)],
        ];
    }

    /**
     * @dataProvider provideInvalidCntrl
     */
    function testInvalidCtypeCntrl($text)
    {
        $this->assertFalse(PF::ctype_cntrl($text));
    }

    static function provideInvalidCntrl()
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
            [53],
            [65],
            [98],
            [43],
            [280],
            ['asd df'],
            [''],
            ['é'],
            ['1234'],
            ['13addfadsf2'],
            ["\x00adf"],
            [\chr(127) . 'adf'],
        ];
    }
}
