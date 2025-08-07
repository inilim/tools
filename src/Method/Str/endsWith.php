<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string ends with a given substring.
 * @param string|iterable<string> $needles
 */
function endsWith(string $haystack, $needles, bool $ignoreCase = false): bool
{
    if (!\is_iterable($needles)) {
        $needles = [$needles];
    }

    foreach ($needles as $needle) {
        if ((string) $needle !== '') {
            if ($ignoreCase) {
                if (\Inilim\Tool\Method\Str\iEndsWithOnce($haystack, $needle)) {
                    return true;
                }
            } else {
                if (\Inilim\Tool\Method\PF\str_ends_with($haystack, $needle)) {
                    return true;
                }
            }
        }
    }

    return false;
}
