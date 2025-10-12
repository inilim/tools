<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Partition the array into two arrays using the given callback.
 *
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<int<0, 1>, array<TKey, TValue>>
 */
function partition($array, callable $callback)
{
    $passed = [];
    $failed = [];

    foreach ($array as $key => $item) {
        if ($callback($item, $key)) {
            $passed[$key] = $item;
        } else {
            $failed[$key] = $item;
        }
    }

    return [$passed, $failed];
}
