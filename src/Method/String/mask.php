<?php

namespace Inilim\Method\String;

/**
 * Masks a portion of a string with a repeated character.
 */
function mask(string $string, string $character, int $index, ?int $length = null, string $encoding = 'UTF-8'): string
{
    if ($character === '') return $string;

    $segment = \mb_substr($string, $index, $length, $encoding);

    if ($segment === '') return $string;

    $strlen = \mb_strlen($string, $encoding);
    $startIndex = $index;

    if ($index < 0) {
        $startIndex = $index < -$strlen ? 0 : $strlen + $index;
    }

    $start      = \mb_substr($string, 0, $startIndex, $encoding);
    $segmentLen = \mb_strlen($segment, $encoding);
    $end        = \mb_substr($string, $startIndex + $segmentLen);

    return $start . \str_repeat(\mb_substr($character, 0, 1, $encoding), $segmentLen) . $end;
}
