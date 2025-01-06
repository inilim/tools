<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('sortRecursive');

/**
 * Recursively sort an array by keys and values in descending order.
 */
function sortRecursiveDesc(array $array, int $options = \SORT_REGULAR): array
{
    return \Inilim\Method\Arr\sortRecursive($array, $options, true);
}
