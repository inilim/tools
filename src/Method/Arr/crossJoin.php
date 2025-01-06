<?php

namespace Inilim\Method\Arr;

/**
 * Cross join the given arrays, returning all possible permutations.
 * @param iterable ...$arrays
 */
function crossJoin(...$arrays): array
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
