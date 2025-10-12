<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author Laravel
 * Flatten a multi-dimensional array into a single level.
 * @param int $depth
 * @return array
 */
function flatten(iterable $array, $depth = \INF)
{
    $result = [];
    $depth  = (int)$depth;

    foreach ($array as $item) {

        if ($item instanceof \Traversable) {
            $item = \iterator_to_array($item);
        }

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
