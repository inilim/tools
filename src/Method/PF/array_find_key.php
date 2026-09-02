<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * 
 * @template TKey of int|string
 * @template TValue
 * @param array<TKey, TValue> $array
 * @param (callable(TValue $value, TKey $key): bool)|(callable(TValue $value): bool) $callback
 * @return TKey|null
 */
function array_find_key(array $array, callable $callback)
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \array_find_key($array, $callback);
    }

    foreach ($array as $key => $value) {
        if ($callback($value, $key)) {
            return $key;
        }
    }

    return null;
}
