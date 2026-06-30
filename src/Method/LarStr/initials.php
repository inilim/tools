<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Get the "initials" representing each word in the provided string, optionally capitalizing.
 *
 * @param  string  $value
 * @param  bool  $capitalize
 * @return string
 * 
 * @ext mbstring
 */
function initials($value, $capitalize = false)
{
    $parts = \preg_split('/\s+/u', $value, -1, \PREG_SPLIT_NO_EMPTY);

    $parts = \array_map(fn($part) => \mb_substr($part, 0, 1), $parts);

    $initials = \implode('', $parts);

    return $capitalize ? \Inilim\Tool\Method\LarStr\upper($initials) : $initials;
}
