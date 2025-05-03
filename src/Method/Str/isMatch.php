<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Determine if a given string matches a given pattern.
 * @param  string|iterable<string> $pattern
 */
function isMatch($pattern, string $value): bool
{
    if (!\is_iterable($pattern)) {
        $pattern = [$pattern];
    }

    foreach ($pattern as $pattern) {
        if (\preg_match((string) $pattern, $value) === 1) {
            return true;
        }
    }

    return false;
}
