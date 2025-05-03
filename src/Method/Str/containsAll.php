<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string contains all array values.
 * @param  iterable<string>  $needles
 */
function containsAll(string $haystack, iterable $needles, bool $ignoreCase = false): bool
{
    foreach ($needles as $needle) {
        if (!\Inilim\Tool\Method\Str\contains($haystack, $needle, $ignoreCase)) {
            return false;
        }
    }

    return true;
}
