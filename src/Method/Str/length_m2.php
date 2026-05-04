<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author inilim
 * Return the length of the given string.
 * Without mbstring
 */
function length_m2(string $value): int
{
    return (int)\preg_match_all('/.{1}/us', $value);
}



// $res = Other::timedMsCall(static function () {
//     for ($i = 0; $i < 1_000_000; $i++) {
//         $str = 'foo bar baz';
//         \mb_strlen($str, 'UTF-8');
//         // \length_m2($str);
//         // \length_m3($str);
//         $str = 'foo bar' . "\n" . 'baz';
//         \mb_strlen($str, 'UTF-8');
//         // \length_m2($str);
//         // \length_m3($str);
//         $str = 'こんにちは';
//         \mb_strlen($str, 'UTF-8');
//         // \length_m2($str);
//         // \length_m3($str);
//         $str = 'こん' . "\n" . 'にちは';
//         \mb_strlen($str, 'UTF-8');
//         // \length_m2($str);
//         // \length_m3($str);
//     }
// });

// 1 млн итераций
// mb_strlen 300ms
// length_m2 > preg_match_all 1700ms
// length_m3 > preg_replace 2500ms