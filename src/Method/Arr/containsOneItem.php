<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @author Laravel
 * Determine if the collection contains exactly one item. If a callback is provided, determine if exactly one item matches the condition.
 */
function containsOneItem(array $array, ?callable $callable = null): bool
{
    if ($callable) {
        return \sizeof(\Inilim\Tool\Method\Arr\where($array, $callable)) === 1;
    }

    return \sizeof($array) === 1;
}
