<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Cross join the given arrays, returning all possible permutations.
 * @param iterable ...$arrays
 * @return array
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
