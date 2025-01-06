<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('has');

/**
 * Determine if any of the keys exist in an array using "dot" notation.
 * @param  \ArrayAccess|array  $array
 * @param  (string|int)[]|int|string|null  $keys
 * @return bool
 */
function hasAny($array, $keys)
{
    if ($keys === null) {
        return false;
    }

    $keys = (array) $keys;

    if (!$array) {
        return false;
    }

    if ($keys === []) {
        return false;
    }

    foreach ($keys as $key) {
        if (\Inilim\Method\Arr\has($array, $key)) {
            return true;
        }
    }

    return false;
}
