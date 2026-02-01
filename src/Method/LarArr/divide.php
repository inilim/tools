<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Divide an array into two arrays. One with keys and the other with values.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>  $array
 * @return array{TKey[], TValue[]}
 */
function divide($array)
{
    return [\array_keys($array), \array_values($array)];
}
