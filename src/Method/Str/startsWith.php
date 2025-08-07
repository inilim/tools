<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string starts with a given substring.
 * @param  string|iterable<string>  $needles
 */
function startsWith(string $haystack, $needles, bool $ignoreCase = false): bool
{
    if (!\is_iterable($needles)) {
        $needles = [$needles];
    }

    foreach ($needles as $needle) {

        if ((string) $needle !== '') {
            if ($ignoreCase) {
                if (\Inilim\Tool\Method\Str\iStartsWithOnce($haystack, $needle)) {
                    return true;
                }
            } else {
                if (\Inilim\Tool\Method\PF\str_starts_with($haystack, $needle)) {
                    return true;
                }
            }
        }
    }

    return false;
}
