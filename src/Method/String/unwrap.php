<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include([
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
    if (\Inilim\Method\String\startsWith($value, $before)) {
        $value = \Inilim\Method\String\substr($value, \Inilim\Method\String\length($before));
    }

    if (\Inilim\Method\String\endsWith($value, $after ??= $before)) {
        $value = \Inilim\Method\String\substr($value, 0, -\Inilim\Method\String\length($after));
    }

    return $value;
}
