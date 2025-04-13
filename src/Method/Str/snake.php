<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Convert a string to snake case.
 * @return string
 */
function snake(string $value, string $delimiter = '_')
{
    if (!\ctype_lower($value)) {
        $value = \preg_replace('/\s+/u', '', \ucwords($value));
        $value = \Inilim\Tool\Method\Str\lower(\preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value));
    }

    return $value;
}
