<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Filter the array using the given callback. array_filter
 * @template TValue
 * @template TKey
 * @param  callable(TValue,TKey)  $callback
 * @param  array<TKey,TValue>  $array
 * @return TValue[]|array<TKey,TValue>
 */
function where(array $array, callable $callback, bool $preserve_keys = true): array
{
    $result = \array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);
    return $preserve_keys ? $result : \array_values($result);
}
