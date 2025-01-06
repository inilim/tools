<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include('__startsWith');

/**
 * Determine if a given string starts with a given substring.
 * @param  string|iterable<string>  $needles
 * @return bool
 */
function startsWith(string $haystack, $needles)
{
    if (!\is_iterable($needles)) $needles = [$needles];

    foreach ($needles as $needle) {
        if ((string) $needle !== '' && \Inilim\Method\String\__startsWith($haystack, $needle)) {
            return true;
        }
    }

    return false;
}
