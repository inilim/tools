<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get the first item in the array, but only if exactly one item exists. Otherwise, throw an exception.
 *
 * @param  array  $array
 * @param  (callable(mixed, array-key): array)|null  $callback
 *
 * @throws \InvalidArgumentException
 */
function sole($array, ?callable $callback = null)
{
    if ($callback) {
        $array = \Inilim\Tool\Method\LarArr\where($array, $callback);
    }

    $count = \count($array);

    if ($count === 0) {
        throw new \InvalidArgumentException('Item Not Found');
    }

    if ($count > 1) {
        throw new \InvalidArgumentException('Multiple Items Found: ' . $count);
    }

    return \Inilim\Tool\Method\LarArr\first($array);
}
