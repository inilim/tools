<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include([
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
    if (\Inilim\Method\String\contains($callback, "@anonymous\0")) {
        if (\Inilim\Method\String\substrCount($callback, '@') > 1) {
            return [
                \Inilim\Method\String\beforeLast($callback, '@'),
                \Inilim\Method\String\afterLast($callback, '@'),
            ];
        }

        return [$callback, $default];
    }

    return \Inilim\Method\String\contains($callback, '@') ? \explode('@', $callback, 2) : [$callback, $default];
}
