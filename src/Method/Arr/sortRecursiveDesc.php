<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Recursively sort an array by keys and values in descending order.
 */
function sortRecursiveDesc(array $array, int $options = \SORT_REGULAR): array
{
    return \Inilim\Tool\Method\Arr\sortRecursive($array, $options, true);
}
