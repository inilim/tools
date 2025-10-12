<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Run a map over each of the items in the array.
 *
 * @param  array  $array
 * @param  callable  $callback
 * @return array
 */
function map(array $array, callable $callback)
{
    $keys = \array_keys($array);

    try {
        $items = \array_map($callback, $array, $keys);
    } catch (\ArgumentCountError $e) {
        $items = \array_map($callback, $array);
    }

    return \array_combine($keys, $items);
}
