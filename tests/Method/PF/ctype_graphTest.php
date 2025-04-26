<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class ctype_graphTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider provideValidGraphs
     */
    function testValidCtypeGraph($text)
    {
        $this->assertTrue(PF::ctype_graph($text));
    }

    static function provideValidGraphs()
    {
        return [
            [-129],
            [-386],
            ['0'],
            [43],
            [53],
            [65],
            [98],
            ['asdf'],
            ['ADD'],
            ['123'],
            ['A1cbad'],
            ['!!'],
            ['!asdF'],
        ];
    }

    /**
     * @dataProvider provideInvalidGraph
     */
    function testInvalidCtypeGraph($text)
    {
        $this->assertFalse(PF::ctype_graph($text));
    }

    static function provideInvalidGraph()
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
            ['asd df'],
            [''],
            ['é'],
            ["\n"],
            ["\x00asdf"],
        ];
    }
}
