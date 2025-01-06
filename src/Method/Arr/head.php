<?php

namespace Inilim\Method\Arr;

/**
 * Get the first element of an array. Useful for method chaining.
 * @template TValue of mixed
 * @param array<TValue> $array
 * @return TValue|false
 */
function head(array $array)
{
    return \reset($array);
}
