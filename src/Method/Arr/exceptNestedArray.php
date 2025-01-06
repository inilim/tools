<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;
// \Inilim\Tool\Method\Arr\

Arr::__include('except');

/**
 * @param  (string|int)[]|string|int $keys
 */
function exceptNestedArray(array $array, $keys, int $depth = 1): array
{
    if ($depth === 0 || $depth < 0) {
        return \Inilim\Tool\Method\Arr\except($array, $keys);
    }
    foreach ($array as $idx =>  $item) {
        if (\is_array($item)) {
            $array[$idx] = \Inilim\Tool\Method\Arr\exceptNestedArray($item, $keys, ($depth - 1));
        }
    }
    return $array;
}
