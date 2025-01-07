<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('contains');

/**
 * Determine if a given string contains all array values.
 * @param  iterable<string>  $needles
 * @return bool
 */
function containsAll(string $haystack, iterable $needles, bool $ignore_case = false)
{
    foreach ($needles as $needle) {
        if (!contains($haystack, $needle, $ignore_case)) {
            return false;
        }
    }

    return true;
}
