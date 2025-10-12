<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Filter the array using the negation of the given callback.
 *
 * @param  array  $array
 * @param  callable  $callback
 * @return array
 */
function reject($array, callable $callback)
{
    return \Inilim\Tool\Method\LarArr\where($array, static fn($value, $key) => ! $callback($value, $key));
}
