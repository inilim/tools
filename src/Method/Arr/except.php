<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Get all of the given array except for a specified array of keys.
 * @template T of array
 * @param T $array
 * @param (string|int)[]|string|int $keys
 * @return T
 */
function except(array $array, $keys)
{
    \Inilim\Tool\Method\Arr\forget()($array, $keys);
    return $array;
}
