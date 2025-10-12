<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get a subset of the items from the given array.
 *
 * @param  array  $array
 * @param  array|string  $keys
 * @return array
 */
function only($array, $keys)
{
    return \array_intersect_key($array, \array_flip((array) $keys));
}
