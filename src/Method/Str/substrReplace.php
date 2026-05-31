<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Replace text within a portion of a string.
 *
 * @ext mbstring
 * @param  string|string[]  $string
 * @param  string|string[]  $replace
 * @param  int|int[]  $offset
 * @param  int|int[]|null  $length
 * @return string|string[]
 */
function substrReplace($string, $replace, $offset = 0, $length = null)
{
    if ($length === null) {
        $length = \Inilim\Tool\Method\Str\length($string);
    }

    return \mb_substr($string, 0, $offset)
        . $replace
        . \mb_substr(\mb_substr($string, $offset), $length);
}
