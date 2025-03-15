<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Inserts the contents of the $inserted array into the $array immediately after the $key.
 * If $key is null (or does not exist), it is inserted at the beginning.
 * @param string|int|null $key
 * @return void
 */
function insertBefore(array &$array, $key, array $inserted)
{
    $offset = $key === null ? 0 : (int) \Inilim\Tool\Method\Arr\getKeyOffset($array, $key);
    $array = \array_slice($array, 0, $offset, true)
        + $inserted
        + \array_slice($array, $offset, \sizeof($array), true);
}
