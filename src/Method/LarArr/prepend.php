<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Push an item onto the beginning of an array.
 *
 * @param  array  $array
 * @param  mixed  $value
 * @param  mixed  $key
 * @return array
 */
function prepend($array, $value, $key = null)
{
    if (\func_num_args() == 2) {
        \array_unshift($array, $value);
    } else {
        $array = [$key => $value] + $array;
    }

    return $array;
}
