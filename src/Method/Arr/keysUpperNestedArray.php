<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('keysUpper');

function keysUpperNestedArray(array $array, int $depth = 1): array
{
    if ($depth === 0 || $depth < 0) {
        return \Inilim\Method\Arr\keysUpper($array);
    }
    foreach ($array as $idx =>  $item) {
        if (\is_array($item)) {
            $array[$idx] = \Inilim\Method\Arr\keysUpperNestedArray($item, ($depth - 1));
        }
    }
    return $array;
}
