<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get a subset of the items from the given array by value.
 *
 * @param  array  $array
 * @param  mixed  $values
 * @param  bool  $strict
 * @return array
 */
function onlyValues($array, $values, $strict = false)
{
    $values = (array) $values;

    return \array_filter($array, static function ($value) use ($values, $strict) {
        return \in_array($value, $values, $strict);
    });
}
