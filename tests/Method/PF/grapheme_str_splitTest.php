<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;

/**
 */
class grapheme_str_splitTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @dataProvider graphemeStrSplitDataProvider
     */
    function test(string $string, int $length, array $expectedValues)
    {
        $this->assertSame($expectedValues, PF::grapheme_str_split($string, $length));
    }

    static function graphemeStrSplitDataProvider(): array
    {
        $cases = [
            ['', 1, []],
            ['PHP', 1, ['P', 'H', 'P']],
            ['你好', 1, ['你', '好']],
            ['අයේෂ්', 1, ['අ', 'යේ', 'ෂ්']],
            ['สวัสดี', 2, ['สวั', 'สดี']],
        ];

        if (70300 <= PHP_VERSION_ID) {
            $cases[] = ['土下座🙇‍♀を', 1, ["土", "下", "座", "🙇‍♀", "を"]];
        }

        // Fixed in https://github.com/PCRE2Project/pcre2/issues/410
        if (defined('PCRE_VERSION_MAJOR') && 10 < PCRE_VERSION_MAJOR && 44 < PCRE_VERSION_MINOR) {
            $cases[] = ['👭🏻👰🏿‍♂️', 2, ['👭🏻', '👰🏿‍♂️']];
        }

        return $cases;
    }
}
