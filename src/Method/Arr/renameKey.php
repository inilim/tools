<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('getKeyOffset');

/**
 * Renames key in array.
 * @param string|int $oldKey
 * @param string|int $newKey
 * @return bool
 */
function renameKey(array &$array, $oldKey, $newKey)
{
    $offset = \Inilim\Method\Arr\getKeyOffset($array, $oldKey);
    if ($offset === null) {
        return false;
    }

    $val = &$array[$oldKey];
    $keys = \array_keys($array);
    $keys[$offset] = $newKey;
    $array = \array_combine($keys, $array);
    $array[$newKey] = &$val;
    return true;
}
