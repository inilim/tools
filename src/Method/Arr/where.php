<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * Filter the array using the given callback. array_filter
 * @template TValue
 * @template TKey
 * @param  callable(TValue,TKey)  $callback
 * @param  array<TKey,TValue>  $array
 * @return TValue[]|array<TKey,TValue>
 */
function where(array $array, callable $callback, bool $preserveKeys = true): array
{
    $result = \array_filter($array, $callback, \ARRAY_FILTER_USE_BOTH);
    return $preserveKeys ? $result : \array_values($result);
}
