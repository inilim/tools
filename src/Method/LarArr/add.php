<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Add an element to an array using "dot" notation if it doesn't exist.
 *
 * @param  array  $array
 * @param  string|int|float  $key
 * @param  mixed  $value
 * @return array
 */
function add($array, $key, $value)
{
    // INFO laravel bug
    if (\is_float($key)) {
        $key = (string) $key;
    }
    if (\is_null(\Inilim\Tool\Method\LarArr\get($array, $key))) {
        \Inilim\Tool\Method\LarArr\set()($array, $key, $value);
    }

    return $array;
}
