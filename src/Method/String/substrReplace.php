<?php

namespace Inilim\Tool\Method\String;

/**
 * Replace text within a portion of a string.
 * @param  string|string[]  $string
 * @param  string|string[]  $replace
 * @param  int|int[]  $offset
 * @param  int|int[]|null  $length
 * @return string|string[]
 */
function substrReplace($string, $replace, $offset = 0, $length = null)
{
    if ($length === null) $length = \strlen($string);

    return \substr_replace($string, $replace, $offset, $length);
}
