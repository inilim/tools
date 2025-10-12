<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get all of the given array except for a specified array of keys.
 *
 * @param  array  $array
 * @param  array|string|int|float  $keys
 * @return array
 */
function except($array, $keys)
{
    \Inilim\Tool\Method\LarArr\forget()($array, $keys);

    return $array;
}
