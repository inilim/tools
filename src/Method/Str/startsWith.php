<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string starts with a given substring.
 * @param  string|iterable<string>  $needles
 */
function startsWith(string $haystack, $needles, bool $ignoreCase = false): bool
{
    if ($ignoreCase) {
        $haystack = \mb_strtolower($haystack, 'UTF-8');
    }

    if (!\is_iterable($needles)) {
        $needles = [$needles];
    }

    foreach ($needles as $needle) {
        if ($ignoreCase) {
            $needle = \mb_strtolower($needle, 'UTF-8');
        }

        if ((string) $needle !== '' && \Inilim\Tool\Method\PF\str_starts_with($haystack, $needle)) {
            return true;
        }
    }

    return false;
}
