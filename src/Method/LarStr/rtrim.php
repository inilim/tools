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

        return \preg_replace('~[\s' . \Inilim\Tool\Method\Str\__state()::INVISIBLE_CHARACTERS . $rtrimDefaultCharacters . ']+$~u', '', $value) ?? \rtrim($value);
    }

    return \rtrim($value, $charlist);
}
