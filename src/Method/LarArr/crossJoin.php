<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Cross join the given arrays, returning all possible permutations.
 *
 * @template TValue
 *
 * @param  iterable<TValue>  ...$arrays
 * @return array<int, array<array-key, TValue>>
 */
function crossJoin(...$arrays)
{
    $results = [[]];

    foreach ($arrays as $index => $array) {
        $append = [];

        foreach ($results as $product) {
            foreach ($array as $item) {
                $product[$index] = $item;

                $append[] = $product;
            }
        }

        $results = $append;
    }

    return $results;
}
