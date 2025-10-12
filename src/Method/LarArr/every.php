<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine if all items pass the given truth test.
 *
 * @param  iterable  $array
 * @param  (callable(mixed, array-key): bool)  $callback
 * @return bool
 */
function every($array, callable $callback)
{
    return \Inilim\Tool\Method\PF\array_all($array, $callback);
}
