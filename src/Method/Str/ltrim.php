<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove all whitespace from the beginning of a string.
 * @return string
 */
function ltrim(string $value, ?string $charlist = null)
{
    if ($charlist === null) {
        $ltrimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}' . $ltrimDefaultCharacters . ']+~u', '', $value) ?? \ltrim($value);
    }

    return \ltrim($value, $charlist);
}
