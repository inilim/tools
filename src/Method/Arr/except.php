<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author Laravel
 * Get all of the given array except for a specified array of keys.
 * @template T of array
 * @param T $array
 * @param (string|int)[]|string|int $keys
 * @return T
 */
function except(array $array, $keys): array
{
    \Inilim\Tool\Method\LarArr\forget()($array, $keys);
    return $array;
}
