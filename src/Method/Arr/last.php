<?php

namespace Inilim\Method\Arr;

/**
 * Get the last element from an array.
 * @template TValue of mixed
 * @param array<TValue> $array
 * @return TValue|false
 */
function last(array $array)
{
    return \end($array);
}
