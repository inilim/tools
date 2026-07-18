<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * Get a value from the array, and remove it.
 * @return \Closure(array &$array, string|int $key, mixed $default):mixed
 */
function pull(): \Closure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());

    return static function (array &$array, $key, $default = null) {
        $value = \Inilim\Tool\Method\LarArr\get($array, $key, $default);
        \Inilim\Tool\Method\LarArr\forget()($array, $key);
        return $value;
    };
}
