<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author laravel
 * Get the first item in the collection, but only if exactly one item exists. Otherwise, throw an exception.
 *
 * @return mixed
 *
 * @throws \Illuminate\Support\ItemNotFoundException
 * @throws \Illuminate\Support\MultipleItemsFoundException
 */
function sole(array $array, ?callable $callback = null)
{
    if ($callback) {
        $array = \Inilim\Tool\Method\Arr\where($array, $callback);
    }

    $count = \sizeof($array);

    if ($count === 0) {
        throw new \Exception('Item not found');
    }

    if ($count > 1) {
        throw new \Exception('Multiple items found: ' . $count);
    }

    return \Inilim\Tool\Method\Arr\first($array);
}
