<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author laravel
 * Filter the array using the negation of the given callback.
 * @param  callable  $callback
 */
function reject(array $array, callable $callback): array
{
    return \Inilim\Tool\Method\Arr\where($array, static fn($value, $key) => ! $callback($value, $key));
}
