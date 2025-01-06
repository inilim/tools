<?php

namespace Inilim\Method\Arr;

/**
 * Get a subset of the items from the given array.
 * @param  (string|int)[]|string|int  $keys
 */
function only(array $array, $keys): array
{
    return \array_intersect_key($array, \array_flip((array) $keys));
}
