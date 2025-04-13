<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert the given value to a string or return the given fallback on failure.
 * @param  mixed  $value
 * @return string
 */
function toStringOr($value, string $fallback)
{
    try {
        return (string) $value;
    } catch (\Throwable $e) {
        return $fallback;
    }
}
