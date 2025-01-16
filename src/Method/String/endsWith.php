<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('_endsWith');

/**
 * Determine if a given string ends with a given substring.
 * @param  string|iterable<string>  $needles
 * @return bool
 */
function endsWith(string $haystack, $needles)
{
    if (!\is_iterable($needles)) $needles = (array) $needles;

    foreach ($needles as $needle) {
        if ((string) $needle !== '' && _endsWith($haystack, $needle)) {
            return true;
        }
    }

    return false;
}
