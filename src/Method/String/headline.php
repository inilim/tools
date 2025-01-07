<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include([
    'ucsplit',
    'title',
    'replace',
]);

/**
 * Convert the given string to proper case for each word.
 */
function headline(string $value): string
{
    $parts = \explode(' ', $value);

    $parts = \sizeof($parts) > 1
        // @see \Inilim\Tool\Method\String\title();
        ? \array_map('\Inilim\Tool\Method\String\title', $parts)
        : \array_map('\Inilim\Tool\Method\String\title', ucsplit(\implode('_', $parts)));

    $collapsed = replace(['-', '_', ' '], '_', \implode('_', $parts));

    return \implode(' ', \array_filter(\explode('_', $collapsed)));
}
