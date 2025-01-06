<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('getKeyOffset');

/**
 * Inserts the contents of the $inserted array into the $array before the $key.
 * If $key is null (or does not exist), it is inserted at the end.
 * @param string|int|null $key
 * @return void
 */
function insertAfter(array &$array, $key, array $inserted)
{
    if ($key === null || ($offset = \Inilim\Tool\Method\Arr\getKeyOffset($array, $key)) === null) {
        $offset = \sizeof($array) - 1;
    }

    $array = \array_slice($array, 0, $offset + 1, true)
        + $inserted
        + \array_slice($array, $offset + 1, \sizeof($array), true);
}
