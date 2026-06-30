<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @deprecated LarStr
 * Replace a given value in the string sequentially with an array. |
 * 
 * $string = 'The event will take place between ? and ?'; |
 * $replaced = Str::replaceArray('?', ['8:30', '9:00'], $string); |
 *
 * @param iterable<string> $replace
 * @return string
 */
function replaceArray(string $search, $replace, string $subject)
{
    $replace = \Inilim\Tool\Method\Arr\from($replace);

    $segments = \explode($search, $subject);
    $result   = \array_shift($segments);

    foreach ($segments as $segment) {
        $result .= \Inilim\Tool\Method\Str\toStringOr(\array_shift($replace) ?? $search, $search) . $segment;
    }

    return $result;
}
