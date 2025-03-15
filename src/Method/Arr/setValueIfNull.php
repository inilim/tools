<?php

namespace Inilim\Tool\Method\Arr;

/**
 * установить значение если значение по ключу null
 * @param mixed $value
 * @return bool
 */
function setValueIfNull(array &$array, string $key, $value)
{
    if (\Inilim\Tool\Method\Arr\has($array, $key) && \Inilim\Tool\Method\Arr\get($array, $key) === null) {
        \Inilim\Tool\Method\Arr\set($array, $key, $value);
        return true;
    }
    return false;
}
