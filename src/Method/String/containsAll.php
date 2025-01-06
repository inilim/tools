<?php

namespace Inilim\Tool\Method\String;

use Inilim\Tool\Str;

Str::__include('contains');

/**
 * Determine if a given string contains all array values.
 * @param  iterable<string>  $needles
 * @return bool
 */
function containsAll(string $haystack, iterable $needles, bool $ignore_case = false)
{
    foreach ($needles as $needle) {
        if (!\Inilim\Tool\Method\String\contains($haystack, $needle, $ignore_case)) {
            return false;
        }
    }

    return true;
}
