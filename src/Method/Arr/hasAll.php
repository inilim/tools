<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Determine if all keys exist in an array using "dot" notation.
 * @param  \ArrayAccess|mixed[]  $array
 * @param  string|string[]  $keys
 */
function hasAll($array, $keys): bool
{
    $keys = (array) $keys;

    if (! $array || $keys === []) {
        return false;
    }

    foreach ($keys as $key) {
        if (! \Inilim\Tool\Method\Arr\has($array, $key)) {
            return false;
        }
    }

    return true;
}
