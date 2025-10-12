<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Recursively sort an array by keys and values.
 *
 * @param  array  $array
 * @param  int  $options
 * @param  bool  $descending
 * @return array
 */
function sortRecursive($array, $options = \SORT_REGULAR, $descending = false)
{
    foreach ($array as &$value) {
        if (\is_array($value)) {
            $value = \Inilim\Tool\Method\LarArr\sortRecursive($value, $options, $descending);
        }
    }

    if (! \Inilim\Tool\Method\PF\array_is_list($array)) {
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
