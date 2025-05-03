<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

function str_ends_with(string $haystack, string $needle): bool
{
    if (\Inilim\Tool\Method\Check\php80()) {
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
