<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine if any of the keys exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|array  $keys
 * @return bool
 */
function hasAny($array, $keys)
{
    if (\is_null($keys)) {
        return false;
    }

    $keys = (array) $keys;

    if (! $array) {
        return false;
    }

    if ($keys === []) {
        return false;
    }

    foreach ($keys as $key) {
        if (\Inilim\Tool\Method\LarArr\has($array, $key)) {
            return true;
        }
    }

    return false;
}
