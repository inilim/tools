<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string ends with a given substring.
 * @param string|iterable<string> $needles
 * @return bool
 */
function endsWith(string $haystack, $needles)
{
    if (!\is_iterable($needles)) $needles = [$needles];

    foreach ($needles as $needle) {
        if ((string) $needle !== '' && \Inilim\Tool\Method\Str\_endsWith($haystack, $needle)) {
            return true;
        }
    }

    return false;
}
