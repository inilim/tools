<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include('length');

/**
 * Limit the number of words in a string.
 */
function words(string $value, int $words = 100, string $end = '...'): string
{
    \preg_match('/^\s*+(?:\S++\s*+){1,' . $words . '}/u', $value, $matches);

    if (!isset($matches[0]) || \Inilim\Method\String\length($value) === \Inilim\Method\String\length($matches[0])) {
        return $value;
    }

    return \rtrim($matches[0]) . $end;
}
