<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Return the first element in an array passing a given truth test.
 * @template TKey
 * @template TValue
 * @template TFirstDefault
 * @param  iterable<TKey, TValue>  $array
 * @param  (callable(TValue, TKey): bool)|null  $callback
 * @param  TFirstDefault|(\Closure(): TFirstDefault)  $default
 * @return TValue|TFirstDefault
 */
function head(iterable $array, ?callable $callback = null, $default = null)
{
    if ($callback === null) {
        if (empty($array)) {
            return \Inilim\Tool\Method\Arr\value($default);
        }

        foreach ($array as $item) {
            return $item;
        }

        return \Inilim\Tool\Method\Arr\value($default);
    }

    foreach ($array as $key => $value) {
        if ($callback($value, $key)) {
            return $value;
        }
    }

    return \Inilim\Tool\Method\Arr\value($default);
}
