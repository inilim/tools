<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string contains a given substring.
 * @param string|iterable<string> $needles
 */
function contains(string $haystack, $needles, bool $ignoreCase = false): bool
{
    if (!\is_iterable($needles)) {
        $needles = (array) $needles;
    }
    foreach ($needles as $needle) {
        if ($needle !== '') {
            if ($ignoreCase) {
                if (\Inilim\Tool\Method\Str\iContainsOnce($haystack, $needle)) {
                    return true;
                }
            } else {
                if (\Inilim\Tool\Method\PF\str_contains($haystack, $needle)) {
                    return true;
                }
            }
        }
    }

    return false;
}
