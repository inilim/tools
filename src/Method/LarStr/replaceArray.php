<?php

namespace Inilim\Tool\Method\LarStr;

/**
 * Replace a given value in the string sequentially with an array.
 *
 * @param  string  $search
 * @param  iterable<string>  $replace
 * @param  string  $subject
 * @return string
 */
function replaceArray($search, $replace, $subject)
{
    if ($replace instanceof \Traversable) {
        $replace = \iterator_to_array($replace);
    }

    $segments = \explode($search, $subject);

    $result = \array_shift($segments);

    foreach ($segments as $segment) {
        $result .= \Inilim\Tool\Method\LarStr\toStringOr(\array_shift($replace) ?? $search, $search) . $segment;
    }

    return $result;
}
