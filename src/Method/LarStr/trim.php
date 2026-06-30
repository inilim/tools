<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Remove all whitespace from both ends of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
function trim($value, $charlist = null)
{
    if ($charlist === null) {
        $trimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        $c = \Inilim\Tool\Method\Str\__state()::INVISIBLE_CHARACTERS;
        return \preg_replace('~^[\s' . $c . $trimDefaultCharacters . ']+|[\s' . $c . $trimDefaultCharacters . ']+$~u', '', $value) ?? \trim($value);
    }

    return \trim($value, $charlist);
}
