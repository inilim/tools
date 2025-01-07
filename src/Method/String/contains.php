<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('__contains');

/**
 * Determine if a given string contains a given substring.
 * @param string|iterable<string> $needles
 * @return bool
 */
function contains(string $haystack, $needles, bool $ignoreCase = false)
{
    if ($ignoreCase) $haystack = \mb_strtolower($haystack, 'UTF-8');

    if (!\is_iterable($needles)) $needles = (array) $needles;

    foreach ($needles as $needle) {
        if ($ignoreCase) $needle = \mb_strtolower($needle, 'UTF-8');

        if ($needle !== '' && __contains($haystack, $needle)) {
            return true;
        }
    }

    return false;
}
