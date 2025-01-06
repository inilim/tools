<?php

namespace Inilim\Method\Arr;

/**
 * @template TValue
 * @template TKey
 * @param mixed $filteringValue
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey):mixed $callback
 */
function mapFilter(array $array, callable $callback, $filteringValue = null, bool $preserveKeys = false): array
{
    $result = [];
    foreach ($array as $key => $value) {
        $t = $callback($value, $key);
        if ($t !== $filteringValue) {
            if ($preserveKeys) $result[$key] = $t;
            else $result[] = $t;
        }
    }

    return $result;
}
