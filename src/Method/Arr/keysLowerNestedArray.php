<?php

namespace Inilim\Tool\Method\Arr;

function keysLowerNestedArray(array $array, int $depth = 1): array
{
    if ($depth <= 0) {
        return \Inilim\Tool\Method\Arr\keysLower($array);
    }
    foreach ($array as $idx =>  $item) {
        if (\is_array($item)) {
            $array[$idx] = \Inilim\Tool\Method\Arr\keysLowerNestedArray($item, ($depth - 1));
        }
    }
    return $array;
}
