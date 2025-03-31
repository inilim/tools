<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @param mixed[]|mixed $values
 * @return bool
 */
function hasValue(array $array, $values, bool $strict = false)
{
    $values = \Inilim\Tool\Method\Arr\wrap($values);

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
