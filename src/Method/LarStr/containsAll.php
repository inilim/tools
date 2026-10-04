<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Determine if a given string contains all array values.
 *
 * @param  string  $haystack
 * @param  iterable<string>  $needles
 * @param  bool  $ignoreCase
 * @return ($needles is array{} ? false : ($haystack is non-empty-string ? bool : false))
 */
function containsAll($haystack, $needles, $ignoreCase = false)
{
    $any = false;

    foreach ($needles as $needle) {
        $any = true;

        if (! \Inilim\Tool\Method\LarStr\contains($haystack, $needle, $ignoreCase)) {
            return false;
        }
    }

    return $any;
}
