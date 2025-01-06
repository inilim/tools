<?php

namespace Inilim\Method\Arr;

/**
 * Run a map over each of the items in the array.
 * @template TValue
 * @template TKey
 * @template TReturn
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey):TReturn $callback
 * @return TReturn[]
 */
function map(array $array, callable $callback): array
{
    $keys = \array_keys($array);

    try {
        $items = \array_map($callback, $array, $keys);
    } catch (\ArgumentCountError $e) {
        $items = \array_map($callback, $array);
    }

    return \array_combine($keys, $items);
}
