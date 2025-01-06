<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'get',
    'forget',
]);

/**
 * Get a value from the array, and remove it.
 *
 * @param  string|int  $key
 * @param  mixed  $default
 * @return mixed
 */
function pull(array &$array, $key, $default = null)
{
    $value = \Inilim\Tool\Method\Arr\get($array, $key, $default);
    \Inilim\Tool\Method\Arr\forget($array, $key);
    return $value;
}
