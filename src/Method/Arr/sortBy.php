<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('dataGet');

/**
 * @template TArray of array
 * @param TArray $arr
 * @return TArray
 */
function sortBy(array $arr, string $by, int $options = \SORT_REGULAR, bool $descending = false): array
{
    $t = [];
    foreach ($arr as $key => $value) {
        $t[$key] = \Inilim\Tool\Method\Arr\dataGet($value, $by);
    }

    $descending ? \arsort($t, $options) : \asort($t, $options);

    foreach (\array_keys($t) as $key) {
        $t[$key] = $arr[$key];
    }

    return $t;
}
