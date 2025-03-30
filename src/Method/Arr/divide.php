<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Divide an array into two arrays. One with keys and the other with values.
 * @template K
 * @template V
 * @param array<K,V> $array
 * @return array{K[],V[]}
 */
function divide(array $array)
{
    return [\array_keys($array), \array_values($array)];
}
