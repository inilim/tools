<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

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
        $rtrimDefaultCharacters = " \n\r\t\v\0";

        return \preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}' . $rtrimDefaultCharacters . ']+$~u', '', $value) ?? \rtrim($value);
    }

    return \rtrim($value, $charlist);
}
