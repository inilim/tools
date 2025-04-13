<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Parse a Class[@]method style callback into class and method.
 * @return array<int, string|null>
 */
function parseCallback(string $callback, ?string $default = null): array
{
    if (\Inilim\Tool\Method\Str\contains($callback, "@anonymous\0")) {
        if (\Inilim\Tool\Method\Str\substrCount($callback, '@') > 1) {
            return [
                \Inilim\Tool\Method\Str\beforeLast($callback, '@'),
                \Inilim\Tool\Method\Str\afterLast($callback, '@'),
            ];
        }

        return [$callback, $default];
    }

    return \Inilim\Tool\Method\Str\contains($callback, '@') ? \explode('@', $callback, 2) : [$callback, $default];
}
