<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Returns the number of substring occurrences.
 * @return int
 */
function substrCount(string $haystack, string $needle, int $offset = 0, ?int $length = null)
{
    if ($length !== null) {
        return \substr_count($haystack, $needle, $offset, $length);
    }

    return \substr_count($haystack, $needle, $offset);
}
