<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Inserts the contents of the $inserted array into the $array immediately after the $key.
 * If $key is null (or does not exist), it is inserted at the beginning.
 * @return \Closure(array &$array, string|int|null $key, array $inserted):void
 */
function insertBefore()
{
    return static function (array &$array, $key, array $inserted) {
        $offset = $key === null ? 0 : (int) \Inilim\Tool\Method\Arr\getKeyOffset($array, $key);
        $array = \array_slice($array, 0, $offset, true)
            + $inserted
            + \array_slice($array, $offset, \sizeof($array), true);
    };
}
