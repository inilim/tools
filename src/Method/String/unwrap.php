<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'startsWith',
    'endsWith',
    'substr',
    'length',
]);

/**
 * Unwrap the string with the given strings.
 */
function unwrap(string $value, string $before, ?string $after = null): string
{
    if (startsWith($value, $before)) {
        $value = substr($value, length($before));
    }

    if (endsWith($value, $after ??= $before)) {
        $value = substr($value, 0, -length($after));
    }

    return $value;
}
