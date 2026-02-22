<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * If the given value is not an array, wrap it in one.
 * 
 * @template TKey of array-key = array-key
 * @template TValue
 * 
 * @author inilim
 * @param  array<TKey, TValue>|TValue  $value
 * @return ($value is array ? array<TKey, TValue> : array{TValue})
 */
function wrap($value): array
{
    return \is_array($value) ? $value : [$value];
}
