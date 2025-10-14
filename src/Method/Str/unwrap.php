<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Unwrap the string with the given strings.
 */
function unwrap(string $value, string $before, ?string $after = null): string
{
    if (\Inilim\Tool\Method\PF\str_starts_with($value, $before)) {
        $value = \Inilim\Tool\Method\Str\substr($value, \Inilim\Tool\Method\Str\length($before));
    }

    if (\Inilim\Tool\Method\PF\str_ends_with($value, $after ??= $before)) {
        $value = \Inilim\Tool\Method\Str\substr($value, 0, -\Inilim\Tool\Method\Str\length($after));
    }

    return $value;
}
