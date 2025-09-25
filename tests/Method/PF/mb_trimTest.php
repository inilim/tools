<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use Inilim\Tool\VD;

/**
 */
class mb_trimTest extends \Inilim\Tool\Test\TestCase
{
    function testMbTrimException()
    {
        $this->expectException(\Error::class);
        PF::mb_trim("\u{180F}", '', 'NULL');
    }

    function testMbTrimEncoding()
    {
        $this->assertSame('あ', mb_convert_encoding(PF::mb_trim("\x81\x40\x82\xa0\x81\x40", "\x81\x40", 'SJIS'), 'UTF-8', 'SJIS'));
    }

    /**
     * @dataProvider data
     */
    function testMbTrim(string $expected, string $string, ?string $characters = null, ?string $encoding = null)
    {
        $this->assertSame($expected, PF::mb_trim($string, $characters, $encoding));
    }


    function testMbTrimCharactersEncoding()
    {
        $strUtf8 = "\u{3042}\u{3000}";

        $this->assertSame(1, mb_strlen(PF::mb_trim($strUtf8)));
        $this->assertSame(1, mb_strlen(PF::mb_trim($strUtf8, null, 'UTF-8')));

        $old = mb_internal_encoding();
        mb_internal_encoding('Shift_JIS');
        $strSjis = mb_convert_encoding($strUtf8, 'Shift_JIS', 'UTF-8');

        $this->assertSame(1, mb_strlen(PF::mb_trim($strSjis)));
        $this->assertSame(1, mb_strlen(PF::mb_trim($strSjis, null, 'Shift_JIS')));
        mb_internal_encoding($old);
    }

    static function data(): iterable
    {
        yield ['ABC', 'ABC'];
        yield ['ABC', "\0\t\nABC \0\t\n"];
        yield ["\0\t\nABC \0\t\n", "\0\t\nABC \0\t\n", ''];

        yield ['', ''];

        yield ['あいうえおあお', ' あいうえおあお ', ' ', 'UTF-8'];
        yield ['foo BAR Spa', 'foo BAR Spaß', 'ß', 'UTF-8'];
        yield ['oo BAR Spaß', 'oo BAR Spaß', 'f', 'UTF-8'];

        yield ['oo BAR Spa', 'foo BAR Spaß', 'ßf', 'UTF-8'];
        yield ['oo BAR Spa', 'foo BAR Spaß', 'fß', 'UTF-8'];
        yield ['いうおえお', ' あいうおえお  あ', ' あ', 'UTF-8'];
        yield ['いうおえお', ' あいうおえお  あ', 'あ ', 'UTF-8'];
        yield [' あいうおえお ', ' あいうおえお a', 'あa', 'UTF-8'];
        yield [' あいうおえお  a', ' あいうおえお  a', "\xe3", 'UTF-8'];

        yield ['', str_repeat(' ', 129)];
        yield ['a', str_repeat(' ', 129) . 'a'];

        yield ['', " \f\n\r\v\x00\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}"];

        yield [' abcd ', ' abcd ', ''];

        yield ['f', 'foo', 'oo'];

        yield ["foo\n", "foo\n", 'o'];
    }
}
