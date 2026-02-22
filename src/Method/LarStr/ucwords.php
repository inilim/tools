<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Capitalize the first character of each word in a string.
 *
 * @param  string  $string
 * @param  string  $separators
 * @return ($string is '' ? '' : non-empty-string)
 */
function ucwords($string, $separators = " \t\r\n\f\v")
{
    $pattern = '/(^|[' . \preg_quote($separators, '/') . '])(\p{Ll})/u';

    return \preg_replace_callback($pattern, function ($matches) {
        return $matches[1] . \mb_strtoupper($matches[2]);
    }, $string);
}
