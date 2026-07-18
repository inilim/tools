<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author Laravel
 * Add an element to an array using "dot" notation if it doesn't exist.
 * @template T of array
 * @param T $array
 * @param string|int|float  $key
 * @param mixed $value
 * @return T
 */
function add(array $array, $key, $value)
{
    // INFO laravel bug
    if (\is_float($key)) {
        $key = (string) $key;
    }
    if (\Inilim\Tool\Method\LarArr\get($array, $key) === null) {
        \Inilim\Tool\Method\LarArr\set()($array, $key, $value);
    }

    return $array;
}
