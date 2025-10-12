<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * Push an item onto the beginning of an array.
 * @param array $array
 * @param mixed $value
 * @param mixed $key
 */
function prepend(array $array, $value, $key = null): array
{
    if (\func_num_args() === 2) {
        \array_unshift($array, $value);
    } else {
        $array = [$key => $value] + $array;
    }

    return $array;
}
