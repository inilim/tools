<?php

namespace Inilim\Tool\Method\Arr;

/**
 * Get a value from the array, and remove it.
 * @return \Closure(array &$array, string|int $key, mixed $default):mixed
 */
function pull()
{
    return static function (array &$array, $key, $default = null) {
        $value = \Inilim\Tool\Method\Arr\get($array, $key, $default);
        \Inilim\Tool\Method\Arr\forget()($array, $key);
        return $value;
    };
}
