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
 */
function array_any(array $array, callable $callback): bool
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \array_any($array, $callback);
    }

    foreach ($array as $key => $value) {
        if ($callback($value, $key)) {
            return true;
        }
    }

    return false;
}
