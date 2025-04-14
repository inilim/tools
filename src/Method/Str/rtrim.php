<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove all whitespace from the end of a string.
 * @return string
 */
function rtrim(string $value, ?string $charlist = null)
{
    if ($charlist === null) {
        $rtrimDefaultCharacters = \preg_quote(" \n\r\t\v\0");
        return \preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}' . $rtrimDefaultCharacters . ']+$~u', '', $value) ?? \rtrim($value);
    }

    return \rtrim($value, $charlist);
}
