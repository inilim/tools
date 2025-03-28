<?php

namespace Inilim\Tool\Method\Str;

/**
 * Convert the given string to proper case for each word.
 */
function headline(string $value): string
{
    $parts = \explode(' ', $value);

    $parts = \sizeof($parts) > 1
        // @see \Inilim\Tool\Method\Str\title();
        ? \array_map('\Inilim\Tool\Method\Str\title', $parts)
        : \array_map('\Inilim\Tool\Method\Str\title', \Inilim\Tool\Method\Str\ucsplit(\implode('_', $parts)));

    $collapsed = \Inilim\Tool\Method\Str\replace(['-', '_', ' '], '_', \implode('_', $parts));

    return \implode(' ', \array_filter(\explode('_', $collapsed)));
}
