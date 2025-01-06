<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;
// \Inilim\Method\Arr\

Arr::__include('getKeyOffset');

/**
 * Inserts the contents of the $inserted array into the $array immediately after the $key.
 * If $key is null (or does not exist), it is inserted at the beginning.
 * @param string|int|null $key
 */
function insertBefore(array &$array, $key, array $inserted): void
{
    $offset = $key === null ? 0 : (int) \Inilim\Method\Arr\getKeyOffset($array, $key);
    $array = \array_slice($array, 0, $offset, true)
        + $inserted
        + \array_slice($array, $offset, \sizeof($array), true);
}
