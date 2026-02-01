<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get all of the given array except for a specified array of values.
 *
 * @param  array  $array
 * @param  mixed  $values
 * @param  bool  $strict
 * @return array
 */
function exceptValues($array, $values, $strict = false)
{
    $values = (array) $values;

    return \array_filter($array, static function ($value) use ($values, $strict) {
        return ! \in_array($value, $values, $strict);
    });
}
