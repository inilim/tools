<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'contains',
    'substrCount',
    'beforeLast',
    'afterLast',
]);

/**
 * Parse a Class[@]method style callback into class and method.
 * @return array<int, string|null>
 */
function parseCallback(string $callback, ?string $default = null): array
{
    if (contains($callback, "@anonymous\0")) {
        if (substrCount($callback, '@') > 1) {
            return [
                beforeLast($callback, '@'),
                afterLast($callback, '@'),
            ];
        }

        return [$callback, $default];
    }

    return contains($callback, '@') ? \explode('@', $callback, 2) : [$callback, $default];
}
