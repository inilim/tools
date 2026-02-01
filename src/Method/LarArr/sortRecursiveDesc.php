<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Recursively sort an array by keys and values in descending order.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  int-mask-of<SORT_REGULAR|SORT_NUMERIC|SORT_STRING|SORT_LOCALE_STRING|SORT_NATURAL|SORT_FLAG_CASE>  $options
 * @param  int  $options
 * @return array<TKey, TValue>
 */
function sortRecursiveDesc($array, $options = \SORT_REGULAR)
{
    return \Inilim\Tool\Method\LarArr\sortRecursive($array, $options, true);
}
