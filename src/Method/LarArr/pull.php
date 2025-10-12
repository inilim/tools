<?php

namespace Inilim\Tool\Method\LarArr;

/**
 * Get a value from the array, and remove it.
 *
 * @return \Closure(array $array,string|int $key, mixed $default = null):mixed
 */
function pull(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());
    return static function (&$array, $key, $default = null) {
        $value = \Inilim\Tool\Method\LarArr\get($array, $key, $default);

        \Inilim\Tool\Method\LarArr\forget()($array, $key);

        return $value;
    };
}
