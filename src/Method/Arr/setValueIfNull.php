<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'has',
    'get',
    'set',
]);

/**
 * установить значение если значение по ключу null
 * @param mixed $value
 */
function setValueIfNull(array &$array, string $key_dot, $value): bool
{
    if (\Inilim\Tool\Method\Arr\has($array, $key_dot) && \Inilim\Tool\Method\Arr\get($array, $key_dot) === null) {
        \Inilim\Tool\Method\Arr\set($array, $key_dot, $value);
        return true;
    }
    return false;
}
