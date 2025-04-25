<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Return the last element in an array passing a given truth test.
 * @template TKey
 * @template TValue
 * @template TLastDefault
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TLastDefault|(\Closure(): TLastDefault)  $default
 * @return TValue|TLastDefault
 */
function last(iterable $array, ?callable $callback = null, $default = null)
{
    if ($callback === null) {
        return empty($array) ? \Inilim\Tool\Method\Arr\value($default) : \end($array);
    }

    return \Inilim\Tool\Method\Arr\head(\array_reverse($array, true), $callback, $default);
}
