<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;

/**
 */
class mb_rtrimTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider data
     */
    function testMbRTrim(string $expected, string $string, ?string $characters = null, ?string $encoding = null)
    {
        $this->assertSame($expected, PF::mb_rtrim($string, $characters, $encoding));
    }

    static function data(): iterable
    {
        yield ['ABC', 'ABC'];
        yield ['ABC', "ABC \0\t\n"];
        yield ["\0\t\nABC \0\t\n", "\0\t\nABC \0\t\n", ''];

        yield ['', ''];

        yield ['                                                                                                                                 a', str_repeat(' ', 129) . 'a'];

        yield ['あああああああああああああああああああああああああああああああああい', 'あああああああああああああああああああああああああああああああああいああああ', 'あ'];

        yield [' abcd ', ' abcd ', ''];

        yield ["foo\n", "foo\n", 'o'];
    }
}
