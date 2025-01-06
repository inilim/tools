<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

/**
 * Recursively sort an array by keys and values.
 */
function sortRecursive(array $array, int $options = \SORT_REGULAR, bool $descending = true): array
{
    foreach ($array as &$value) {
        if (\is_array($value)) {
            $value = \Inilim\Tool\Method\Arr\sortRecursive($value, $options, $descending);
        }
    }

    if (\Inilim\Tool\Method\Arr\isAssoc($array)) {
        $descending
            ? \krsort($array, $options)
            : \ksort($array, $options);
    } else {
        $descending
            ? \rsort($array, $options)
            : \sort($array, $options);
    }

    return $array;
}
