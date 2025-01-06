<?php

namespace Inilim\Tool\Method\String;

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
    if (\Inilim\Tool\Method\String\startsWith($value, $before)) {
        $value = \Inilim\Tool\Method\String\substr($value, \Inilim\Tool\Method\String\length($before));
    }

    if (\Inilim\Tool\Method\String\endsWith($value, $after ??= $before)) {
        $value = \Inilim\Tool\Method\String\substr($value, 0, -\Inilim\Tool\Method\String\length($after));
    }

    return $value;
}
