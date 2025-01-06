<?php

namespace Inilim\Method\String;

/**
 * @return bool
 */
function __endsWith(string $haystack, string $needle)
{
    if (\PHP_VERSION_ID >= 80000) {
        return \str_ends_with($haystack, $needle);
    }

    if ('' === $needle || $needle === $haystack) {
        return true;
    }

    if ('' === $haystack) {
        return false;
    }

    $needleLength = \strlen($needle);

    return $needleLength <= \strlen($haystack) && 0 === \substr_compare($haystack, $needle, -$needleLength);
}
