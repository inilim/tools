<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Flatten a multi-dimensional associative array with dots.
 */
function dot(iterable $array, string $prepend = ''): array
{
    $results = [];

    foreach ($array as $key => $value) {
        if (\is_array($value) && !empty($value)) {
            $results = \array_merge($results, dot($value, $prepend . $key . '.'));
        } else {
            $results[$prepend . $key] = $value;
        }
    }

    return $results;
}
