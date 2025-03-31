<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * @template TValue of mixed
 * @template TKey of int|string
 * @template TOffset of int
 * @param mixed $filteringValue
 * @param array<TKey,TValue> $array
 * @param callable(TValue,TKey,TOffset):mixed $callback
 */
function mapFilter(array $array, callable $callback, $filteringValue = null, bool $preserveKeys = false): array
{
    $i      = 0;
    $result = [];
    foreach ($array as $key => $value) {
        $t = $callback($value, $key, $i);
        $i++;
        if ($t !== $filteringValue) {
            if ($preserveKeys) $result[$key] = $t;
            else $result[] = $t;
        }
    }

    return $result;
}
