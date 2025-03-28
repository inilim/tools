<?php

namespace Inilim\Tool\Method\Str;

/**
 * Convert a string to snake case.
 */
function snake(string $value, string $delimiter = '_'): string
{
    if (!\ctype_lower($value)) {
        $value = \preg_replace('/\s+/u', '', \ucwords($value));
        $value = \Inilim\Tool\Method\Str\lower(\preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value));
    }

    return $value;
}
