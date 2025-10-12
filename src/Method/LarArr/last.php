<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Return the last element in an array passing a given truth test.
 *
 * @template TKey
 * @template TValue
 * @template TLastDefault
 *
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TLastDefault|(\Closure(): TLastDefault)  $default
 * @return TValue|TLastDefault
 */
function last($array, ?callable $callback = null, $default = null)
{
    if (\is_null($callback)) {
        return empty($array) ? \Inilim\Tool\Method\Lar\value($default) : \Inilim\Tool\Method\PF\array_last($array);
    }

    return \Inilim\Tool\Method\LarArr\first(\array_reverse($array, true), $callback, $default);
}
