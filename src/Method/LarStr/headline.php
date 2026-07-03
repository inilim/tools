<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Convert the given string to proper case for each word.
 *
 * @param  string  $value
 * @return string
 */
function headline($value)
{
    $parts = \preg_split('/\s+/u', $value, -1, \PREG_SPLIT_NO_EMPTY);

    $parts = \count($parts) > 1
        // @deps(\Inilim\Tool\Method\LarStr\title)
        ? \array_map('\Inilim\Tool\Method\LarStr\title', $parts)
        : \array_map('\Inilim\Tool\Method\LarStr\title', \Inilim\Tool\Method\LarStr\ucsplit(\implode('_', $parts)));

    $collapsed = \Inilim\Tool\Method\LarStr\replace(['-', '_', ' '], '_', \implode('_', $parts));

    return \implode(' ', \Inilim\Tool\Method\PF\array_filter(\explode('_', $collapsed)));
}
