<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Filter the array using the given callback.
 *
 * @param  array  $array
 * @param  callable  $callback
 * @return array
 */
function where($array, callable $callback)
{
    return \array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);
}
