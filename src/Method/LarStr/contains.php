<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Determine if a given string contains a given substring.
 *
 * @param  string  $haystack
 * @param  string|iterable<string>  $needles
 * @param  bool  $ignoreCase
 * @return ($needles is array{} ? false : ($haystack is non-empty-string ? bool : false))
 * 
 * @ext mbstring
 */
function contains($haystack, $needles, $ignoreCase = false)
{
    if (\is_null($haystack)) {
        return false;
    }

    if ($ignoreCase) {
        $haystack = \mb_strtolower($haystack);
    }

    if (! \is_iterable($needles)) {
        $needles = (array) $needles;
    }

    foreach ($needles as $needle) {
        if ($ignoreCase) {
            $needle = \mb_strtolower($needle);
        }

        if ($needle !== '' && \Inilim\Tool\Method\PF\str_contains($haystack, $needle)) {
            return true;
        }
    }

    return false;
}
