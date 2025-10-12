<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author laravel
 * Check if an item or items exist in an array using "dot" notation.
 *
 * @param  \ArrayAccess|array  $array
 * @param  (string|int)[]|string|int  $keys
 */
function has($array, $keys): bool
{
    $keys = (array) $keys;

    if (!$array || $keys === []) {
        return false;
    }

    foreach ($keys as $key) {
        $subKeyArray = $array;

        if (\Inilim\Tool\Method\Arr\exists($array, $key)) {
            continue;
        }

        foreach (\explode('.', $key) as $segment) {
            if (\Inilim\Tool\Method\Arr\accessible($subKeyArray) && \Inilim\Tool\Method\Arr\exists($subKeyArray, $segment)) {
                $subKeyArray = $subKeyArray[$segment];
            } else {
                return false;
            }
        }
    }

    return true;
}
