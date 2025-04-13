<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Unwrap the string with the given strings.
 */
function unwrap(string $value, string $before, ?string $after = null): string
{
    if (\Inilim\Tool\Method\Str\startsWith($value, $before)) {
        $value = \Inilim\Tool\Method\Str\substr($value, \Inilim\Tool\Method\Str\length($before));
    }

    if (\Inilim\Tool\Method\Str\endsWith($value, $after ??= $before)) {
        $value = \Inilim\Tool\Method\Str\substr($value, 0, -\Inilim\Tool\Method\Str\length($after));
    }

    return $value;
}
