<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Determine if some items pass the given truth test.
 *
 * @param  iterable  $array
 * @param  (callable(mixed, array-key): bool)  $callback
 * @return bool
 */
function some($array, callable $callback)
{
    return \Inilim\Tool\Method\PF\array_any($array, $callback);
}
