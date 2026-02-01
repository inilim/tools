<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Filter the array using the given callback.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<TKey, TValue>
 */
function where($array, callable $callback)
{
    return \array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);
}
