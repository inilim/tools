<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('forget');

/**
 * Get all of the given array except for a specified array of keys.
 * @param  (string|int)[]|string|int $keys
 */
function except(array $array, $keys): array
{
    \Inilim\Tool\Method\Arr\forget($array, $keys);
    return $array;
}
