<?php

namespace Inilim\Method\Arr;


\Inilim\Tool\Arr::__include([
    'get',
    'set',
]);

/**
 * Add an element to an array using "dot" notation if it doesn't exist.
 * @param mixed $value
 * @return array
 */
function add(array $array, string $key, $value)
{
    if (\Inilim\Method\Arr\get($array, $key) === null) {
        \Inilim\Method\Arr\set($array, $key, $value);
    }

    return $array;
}
