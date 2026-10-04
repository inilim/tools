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
        // $trimDefaultCharacters = \preg_quote(" \n\r\t\v\0");
        $trimDefaultCharacters = " \n\r\t\v\0";

        $c = \Inilim\Tool\Method\LarStr\__state()::INVISIBLE_CHARACTERS;
        $whitespace = '[\s' . $c . $trimDefaultCharacters . ']';

        // The trailing match may only begin at the first character of a whitespace run, keeping this linear...
        return \preg_replace('~^' . $whitespace . '+|' . $whitespace . '(?<!' . $whitespace . $whitespace . ')' . $whitespace . '*+$~u', '', $value) ?? \trim($value);
    }

    return \trim($value, $charlist);
}
