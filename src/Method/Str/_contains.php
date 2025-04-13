<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @return bool
 */
function _contains(string $haystack, string $needle)
{
    if (\PHP_VERSION_ID >= 80000) {
        return \str_contains($haystack, $needle);
    }

    return '' === $needle || false !== strpos($haystack, $needle);
}
