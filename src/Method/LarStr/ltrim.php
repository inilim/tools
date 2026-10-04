<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Remove all whitespace from the beginning of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
function ltrim($value, $charlist = null)
{
    if ($charlist === null) {
        // без preg_quote выдает "PHP Warning:  preg_replace(): Null byte in regex ..."
        $ltrimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        $c = \Inilim\Tool\Method\LarStr\__state()::INVISIBLE_CHARACTERS;
        return \preg_replace('~^[\s' . $c . $ltrimDefaultCharacters . ']+~u', '', $value) ?? \ltrim($value);
    }

    return \ltrim($value, $charlist);
}
