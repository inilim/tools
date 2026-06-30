<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert the given value to a string or return the given fallback on failure.
 *
 * @param  mixed  $value
 * @param  string  $fallback
 * @return string
 */
function toStringOr($value, $fallback)
{
    try {
        return (string) $value;
    } catch (\Throwable $e) {
        return $fallback;
    }
}
