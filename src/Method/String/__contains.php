<?php

namespace Inilim\Method\String;

/**
 * @return bool
 */
function __contains(string $haystack, string $needle)
{
    if (\PHP_VERSION_ID >= 80000) {
        return \str_contains($haystack, $needle);
    }

    return '' === $needle || false !== strpos($haystack, $needle);
}
