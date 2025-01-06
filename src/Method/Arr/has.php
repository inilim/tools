<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'exists',
    'accessible',
]);

/**
 * Check if an item or items exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  (string|int)[]|string|int  $keys
 * @return bool
 */
function has($array, $keys)
{
    $keys = (array) $keys;

    if (!$array || $keys === []) {
        return false;
    }

    foreach ($keys as $key) {
        $subKeyArray = $array;

        if (\Inilim\Method\Arr\exists($array, $key)) {
            continue;
        }

        foreach (\explode('.', $key) as $segment) {
            if (\Inilim\Method\Arr\accessible($subKeyArray) && \Inilim\Method\Arr\exists($subKeyArray, $segment)) {
                $subKeyArray = $subKeyArray[$segment];
            } else {
                return false;
            }
        }
    }

    return true;
}
