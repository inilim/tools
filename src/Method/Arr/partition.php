<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author Laravel
 * @author Inilim "Changed it a bit"
 * Partition the array into two arrays using the given callback.
 *
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  callable(TValue, TKey): bool  $callback
 * @return array<int<0, 1>, array<TKey, TValue>>
 */
function partition(iterable $array, callable $callback): array
{
    $passed = [];
    $failed = [];

    foreach ($array as $key => &$item) {
        $t = $item;
        if ($callback($t, $key)) {
            $passed[$key] = $item;
        } else {
            $failed[$key] = $item;
        }
    }

    return [$passed, $failed];
}
