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
        $ltrimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        return \preg_replace('~^[\s' . \Inilim\Tool\Method\LarStr\__state()::INVISIBLE_CHARACTERS . $ltrimDefaultCharacters . ']+~u', '', $value) ?? \ltrim($value);
    }

    return \ltrim($value, $charlist);
}
