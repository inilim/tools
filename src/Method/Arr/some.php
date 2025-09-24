<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * 
 * Determine if some items pass the given truth test.
 *
 * @param (callable(mixed, array-key): bool) $callback
 */
function some(iterable $array, callable $callback): bool
{
    return \Inilim\Tool\Method\PF\array_any($array, $callback);
}
