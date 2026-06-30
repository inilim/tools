<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Filter items where the value is not null.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @param  array<TKey, TValue|null>  $array
 * @return array<TKey, TValue>
 */
function whereNotNull($array)
{
    return \Inilim\Tool\Method\LarArr\where($array, static fn($value) => ! \is_null($value));
}
