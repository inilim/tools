<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Add an element to an array using "dot" notation if it doesn't exist.
 * @template T of array
 * @param T $array
 * @param mixed $value
 * @return T
 */
function add(array $array, string $key, $value)
{
    if (\Inilim\Tool\Method\Arr\get($array, $key) === null) {
        \Inilim\Tool\Method\Arr\set()($array, $key, $value);
    }

    return $array;
}
