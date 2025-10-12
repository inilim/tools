<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine if the given key exists in the provided array.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|int|float  $key
 * @return bool
 */
function exists($array, $key)
{
    // INFO from laravel
    // if ($array instanceof Enumerable) {
    //     return $array->has($key);
    // }

    if ($array instanceof \ArrayAccess) {
        return $array->offsetExists($key);
    }

    if (\is_float($key) || \is_null($key)) {
        $key = (string) $key;
    }

    return \array_key_exists($key, $array);
}
