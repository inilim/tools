<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * If the given value is not an array and not null, wrap it in one.
 *
 * @template TValue
 *
 * @param  TValue  $value
 * @return ($value is null ? array{} : ($value is array ? TValue : array{TValue}))
 */
function wrap($value)
{
    if (\is_null($value)) {
        return [];
    }

    return \is_array($value) ? $value : [$value];
}
