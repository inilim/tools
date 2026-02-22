<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * If the given value is not an array and not null, wrap it in one.
 * 
 * @template TKey of array-key = array-key
 * @template TValue
 *
 * @param  array<TKey, TValue>|TValue|null  $value
 * @return ($value is null ? array{} : ($value is array ? array<TKey, TValue> : array{TValue}))
 */
function wrap($value)
{
    if (\is_null($value)) {
        return [];
    }

    return \is_array($value) ? $value : [$value];
}
