<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Recursively sort an array by keys and values.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  int-mask-of<SORT_REGULAR|SORT_NUMERIC|SORT_STRING|SORT_LOCALE_STRING|SORT_NATURAL|SORT_FLAG_CASE>  $options
 * @param  bool  $descending
 * @return array<TKey, TValue>
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
