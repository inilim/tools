<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated LarStr
 * Remove all whitespace from the end of a string.
 *
 * @param  string  $value
 * @param  string|null  $charlist
 * @return string
 */
function rtrim(string $value, ?string $charlist = null): string
{
    if ($charlist === null) {
        $rtrimDefaultCharacters = \preg_quote(" \n\r\t\v\0");

        return \preg_replace('~[\s' . \Inilim\Tool\Method\Str\__state()::INVISIBLE_CHARACTERS . $rtrimDefaultCharacters . ']+$~u', '', $value) ?? \rtrim($value);
    }

    return \rtrim($value, $charlist);
}
