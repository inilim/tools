<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Filter the array using the negation of the given callback.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<TKey, TValue>
 */
function reject($array, callable $callback)
{
    return \Inilim\Tool\Method\LarArr\where($array, static fn($value, $key) => ! $callback($value, $key));
}
