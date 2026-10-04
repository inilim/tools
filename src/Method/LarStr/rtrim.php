<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Remove all whitespace from the end of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
function rtrim($value, $charlist = null)
{
    if ($charlist === null) {
        $rtrimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        $c = \Inilim\Tool\Method\LarStr\__state()::INVISIBLE_CHARACTERS;
        $whitespace = '[\s' . $c . $rtrimDefaultCharacters . ']';

        // The match may only begin at the first character of a whitespace run, keeping this linear...
        return \preg_replace('~' . $whitespace . '(?<!' . $whitespace . $whitespace . ')' . $whitespace . '*+$~u', '', $value) ?? \rtrim($value);
    }

    return \rtrim($value, $charlist);
}
