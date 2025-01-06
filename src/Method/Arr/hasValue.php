<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('wrap');

/**
 * @param mixed[]|mixed $values
 */
function hasValue(array $array, $values, bool $strict = false): bool
{
    $values = \Inilim\Method\Arr\wrap($values);

    if (!$array || !$values) {
        return false;
    }

    foreach ($values as $value) {
        if (!\in_array($value, $array, $strict)) {
            return false;
        }
    }
    return true;
}
