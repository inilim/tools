<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Return the first element in an array passing a given truth test.
 *
 * @template TKey
 * @template TValue
 * @template TFirstDefault
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TFirstDefault|(\Closure(): TFirstDefault)  $default
 * @return TValue|TFirstDefault
 */
function first($array, ?callable $callback = null, $default = null)
{
    if (\is_null($callback)) {
        if (empty($array)) {
            return \Inilim\Tool\Method\Lar\value($default);
        }

        if (\is_array($array)) {
            return \Inilim\Tool\Method\PF\array_first($array);
        }

        foreach ($array as $item) {
            return $item;
        }

        return \Inilim\Tool\Method\Lar\value($default);
    }

    $key = \Inilim\Tool\Method\PF\array_find_key($array, $callback);

    return $key !== null ? $array[$key] : \Inilim\Tool\Method\Lar\value($default);
}
