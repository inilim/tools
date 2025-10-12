<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Check if an item or items exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  string|array  $keys
 * @return bool
 */
function has($array, $keys)
{
    $keys = (array) $keys;

    if (! $array || $keys === []) {
        return false;
    }

    foreach ($keys as $key) {
        $subKeyArray = $array;

        if (\Inilim\Tool\Method\LarArr\exists($array, $key)) {
            continue;
        }

        foreach (\explode('.', $key) as $segment) {
            if (\Inilim\Tool\Method\LarArr\accessible($subKeyArray) && \Inilim\Tool\Method\LarArr\exists($subKeyArray, $segment)) {
                $subKeyArray = $subKeyArray[$segment];
            } else {
                return false;
            }
        }
    }

    return true;
}
