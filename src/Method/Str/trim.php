<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Remove all whitespace from both ends of a string.
 * @return string
 */
function trim(string $value, ?string $charlist = null)
{
    if ($charlist === null) {
        $trimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        return \preg_replace(
            '~^[\s\x{FEFF}\x{200B}\x{200E}' . $trimDefaultCharacters . ']+|[\s\x{FEFF}\x{200B}\x{200E}' . $trimDefaultCharacters . ']+$~u',
            '',
            $value
        ) ?? \trim($value);
    }

    return \trim($value, $charlist);
}
