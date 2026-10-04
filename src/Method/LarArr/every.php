<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine if all items pass the given truth test.
 *
 * @param  iterable  $array
 * @param  (callable(mixed, array-key): bool)  $callback
 * @return bool
 */
function every($array, callable $callback)
{
    if (\is_array($array)) {
        return \Inilim\Tool\Method\PF\array_all($array, $callback);
    }

    foreach ($array as $key => $value) {
        if (! $callback($value, $key)) {
            return false;
        }
    }

    return true;
}
