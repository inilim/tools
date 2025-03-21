<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Add an element to an array using "dot" notation if it doesn't exist.
 * @template T of array
 * @param T $array
 * @param mixed $value
 * @return T
 */
function add(array $array, string $key, $value)
{
    if (\Inilim\Tool\Arr::get($array, $key) === null) {
        \Inilim\Tool\Arr::set($array, $key, $value);
    }

    return $array;
}
