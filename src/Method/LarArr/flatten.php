<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Flatten a multi-dimensional array into a single level.
 *
 * @param  iterable  $array
 * @param  int  $depth
 * @return array
 */
function flatten($array, $depth = \INF)
{
    $result = [];

    foreach ($array as $item) {
        // INFO
        // $item = $item instanceof Collection ? $item->all() : $item;
        if ($item instanceof \Traversable) {
            $item = \iterator_to_array($item);
        }

        if (! \is_array($item)) {
            $result[] = $item;
        } else {
            $values = $depth === 1
                ? \array_values($item)
                : \Inilim\Tool\Method\LarArr\flatten($item, $depth - 1);

            foreach ($values as $value) {
                $result[] = $value;
            }
        }
    }

    return $result;
}
