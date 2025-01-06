<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'wrap',
    'hasValue',
]);

/**
 * @param mixed[]|mixed $values
 * @return bool
 */
function hasValueAny(array $array, $values, bool $strict = false)
{
    $values = \Inilim\Tool\Method\Arr\wrap($values);

    if (!$array || !$values) {
        return false;
    }

    foreach ($values as $value) {
        if (\Inilim\Tool\Method\Arr\hasValue($array, $value, $strict)) {
            return true;
        }
    }

    return false;
}
