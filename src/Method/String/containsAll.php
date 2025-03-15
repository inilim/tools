<?php

namespace Inilim\Tool\Method\String;

/**
 * Determine if a given string contains all array values.
 * @param  iterable<string>  $needles
 * @return bool
 */
function containsAll(string $haystack, iterable $needles, bool $ignoreCase = false)
{
    foreach ($needles as $needle) {
        if (!\Inilim\Tool\Method\String\contains($haystack, $needle, $ignoreCase)) {
            return false;
        }
    }

    return true;
}
