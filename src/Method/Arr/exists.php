<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Determine if the given key exists in the provided array.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int  $key
 * @return bool
 */
function exists($array, $key)
{
    if ($array instanceof \ArrayAccess) {
        return $array->offsetExists($key);
    }

    return \array_key_exists($key, $array);
}
