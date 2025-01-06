<?php

namespace Inilim\Tool\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include([
    'has',
    'set',
]);

/**
 * установить значение если значения по ключу нет
 * @param mixed $value
 * @return bool
 */
function setValueIfNotExists(array &$array, string $key_dot, $value)
{
    if (!\Inilim\Tool\Method\Arr\has($array, $key_dot)) {
        \Inilim\Tool\Method\Arr\set($array, $key_dot, $value);
        return true;
    }
    return false;
}
