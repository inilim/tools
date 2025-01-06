<?php

namespace Inilim\Method\String;

use Inilim\Tool\Str;

Str::__include([
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
        ? \array_map('\Inilim\Method\String\title', $parts)
        : \array_map('\Inilim\Method\String\title', \Inilim\Method\String\ucsplit(\implode('_', $parts)));

    $collapsed = \Inilim\Method\String\replace(['-', '_', ' '], '_', \implode('_', $parts));

    return \implode(' ', \array_filter(\explode('_', $collapsed)));
}
