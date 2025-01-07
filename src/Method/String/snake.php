<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('lower');

/**
 * Convert a string to snake case.
 */
function snake(string $value, string $delimiter = '_'): string
{
    if (!\ctype_lower($value)) {
        $value = \preg_replace('/\s+/u', '', \ucwords($value));
        $value = lower(\preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value));
    }

    return $value;
}
