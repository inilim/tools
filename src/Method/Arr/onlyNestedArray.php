<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('only');

/**
 * @param  (string|int)[]|string|int $keys
 */
function onlyNestedArray(array $array, $keys, int $depth = 1): array
{
    if ($depth === 0 || $depth < 0) {
        return \Inilim\Tool\Method\Arr\only($array, $keys);
    }
    foreach ($array as $idx =>  $item) {
        if (\is_array($item)) {
            $array[$idx] = \Inilim\Tool\Method\Arr\onlyNestedArray($item, $keys, ($depth - 1));
        }
    }
    return $array;
}
