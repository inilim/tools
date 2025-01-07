<?php

namespace Inilim\Tool\Method\String;

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
        return \preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}]+$~u', '', $value) ?? \rtrim($value);
    }

    return \rtrim($value, $charlist);
}
