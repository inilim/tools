<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine if all keys exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|array  $keys
 * @return bool
 */
function hasAll($array, $keys)
{
    $keys = (array) $keys;

    if (! $array || $keys === []) {
        return false;
    }

    return \Inilim\Tool\Method\PF\array_all($keys, static fn($key) => \Inilim\Tool\Method\LarArr\has($array, $key));
}
