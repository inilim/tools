<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @param  (string|int)[]|string|int $keys
 */
function onlyNestedArray(array $array, $keys, int $depth = 1): array
{
    if ($depth < 1) {
        return \Inilim\Tool\Method\Arr\only($array, $keys);
    }
    foreach ($array as $idx =>  $item) {
        if (\is_array($item)) {
            $array[$idx] = \Inilim\Tool\Method\Arr\onlyNestedArray($item, $keys, ($depth - 1));
        }
    }
    return $array;
}
