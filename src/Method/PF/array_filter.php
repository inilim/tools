<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * Iterates over each value in the <b>array</b>
 * passing them to the <b>callback</b> function.
 * If the <b>callback</b> function returns true, the
 * current value from <b>array</b> is returned into
 * the result array. Array keys are preserved.
 * @link https://php.net/manual/en/function.array-filter.php
 * @template TKey of int|string
 * @template TValue
 * @param array<TKey, TValue> $array <p>
 * The array to iterate over
 * </p>
 * @param ($mode is 1 ? (callable(TValue $value, TKey $key): bool) : ($mode is 2 ? (callable(TKey $key): bool) : (callable(TValue $value): bool)))|null $callback [optional] <p>
 * The callback function to use
 * </p>
 * <p>
 * If no callback is supplied, all entries of
 * input equal to false (see
 * converting to
 * boolean) will be removed.
 * </p>
 * @param int $mode [optional] <p>
 * Flag determining what arguments are sent to <i>callback</i>:
 * </p><ul>
 * <li>
 * <b>ARRAY_FILTER_USE_KEY</b> - pass key as the only argument
 * to <i>callback</i> instead of the value</span>
 * </li>
 * <li>
 * <b>ARRAY_FILTER_USE_BOTH</b> - pass both value and key as
 * arguments to <i>callback</i> instead of the value</span>
 * </li>
 * </ul>
 * @return array<TKey, TValue> the filtered array.
 */
function array_filter(array $array, ?callable $callback = null, int $mode = 0): array
{
    if ($callback !== null) {
        return \array_filter($array, $callback, $mode);
    }

    if (\Inilim\Tool\Method\Check\php80()) {
        return \array_filter($array, null, $mode);
    }

    foreach ($array as $k => $v) {
        if (false === (bool)$v) {
            unset($array[$k]);
        }
    }

    return $array;
}
