<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated LarStr
 * Remove all whitespace from the beginning of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
function ltrim(string $value, ?string $charlist = null): string
{
    if ($charlist === null) {
        // без preg_quote выдает "PHP Warning:  preg_replace(): Null byte in regex ..."
        $ltrimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        return \preg_replace('~^[\s' . \Inilim\Tool\Method\Str\__state()::INVISIBLE_CHARACTERS . $ltrimDefaultCharacters . ']+~u', '', $value) ?? \ltrim($value);
    }

    return \ltrim($value, $charlist);
}
