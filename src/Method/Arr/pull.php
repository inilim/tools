<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * Get a value from the array, and remove it.
 * @return \Closure(array &$array, string|int $key, mixed $default):mixed
 */
function pull()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, $key, $default = null) {
        $value = \Inilim\Tool\Method\Arr\get($array, $key, $default);
        \Inilim\Tool\Method\Arr\forget()($array, $key);
        return $value;
    };
}
