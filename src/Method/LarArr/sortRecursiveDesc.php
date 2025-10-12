<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Recursively sort an array by keys and values in descending order.
 *
 * @param  array  $array
 * @param  int  $options
 * @return array
 */
function sortRecursiveDesc($array, $options = \SORT_REGULAR)
{
    return \Inilim\Tool\Method\LarArr\sortRecursive($array, $options, true);
}
