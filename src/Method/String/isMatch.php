<?php

namespace Inilim\Method\String;

/**
 * Determine if a given string matches a given pattern.
 * @param  string|iterable<string>  $patterns
 * @return bool
 */
function isMatch($patterns, string $value)
{
    if (!\is_iterable($patterns)) $patterns = [$patterns];

    foreach ($patterns as $pattern) {
        if (\preg_match((string) $pattern, $value) === 1) return true;
    }

    return false;
}
