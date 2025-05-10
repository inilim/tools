<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert the given value to a string or return the given fallback on failure.
 * @param  mixed  $value
 */
function toStringOr($value, string $fallback): string
{
    try {
        return (string) $value;
    } catch (\Throwable $e) {
        return $fallback;
    }
}
