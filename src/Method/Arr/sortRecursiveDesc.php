<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * Recursively sort an array by keys and values in descending order.
 */
function sortRecursiveDesc(array $array, int $options = \SORT_REGULAR): array
{
    return \Inilim\Tool\Method\LarArr\sortRecursive($array, $options, true);
}
