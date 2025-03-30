<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Flatten a multi-dimensional array into a single level.
 * @return array
 */
function flatten(iterable $array, int $depth)
{
    $result = [];

    foreach ($array as $item) {
        if (!\is_array($item)) {
            $result[] = $item;
        } else {
            $values = $depth === 1
                ? \array_values($item)
                : \Inilim\Tool\Method\Arr\flatten($item, $depth - 1);

            foreach ($values as $value) {
                $result[] = $value;
            }
        }
    }

    return $result;
}
