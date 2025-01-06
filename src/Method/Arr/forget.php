<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('exists');

/**
 * Remove one or many array items from a given array using "dot" notation.
 * @param  (string|int)[]|string|int  $keys
 */
function forget(array &$array, $keys): void
{
    $original = &$array;

    $keys = (array) $keys;

    if (!$keys) return;

    foreach ($keys as $key) {
        // if the exact key exists in the top-level, remove it
        if (\Inilim\Tool\Method\Arr\exists($array, $key)) {
            unset($array[$key]);

            continue;
        }

        $parts = \explode('.', $key);

        // clean up before each pass
        $array = &$original;

        while (\sizeof($parts) > 1) {
            $part = \array_shift($parts);

            if (isset($array[$part]) && \is_array($array[$part])) {
                $array = &$array[$part];
            } else {
                continue 2;
            }
        }

        unset($array[\array_shift($parts)]);
    }
}
