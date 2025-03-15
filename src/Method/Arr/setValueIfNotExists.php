<?php

namespace Inilim\Tool\Method\Arr;

/**
 * установить значение если значения по ключу нет
 * @param mixed $value
 * @return bool
 */
function setValueIfNotExists(array &$array, string $key, $value)
{
    if (!\Inilim\Tool\Method\Arr\has($array, $key)) {
        \Inilim\Tool\Method\Arr\set($array, $key, $value);
        return true;
    }
    return false;
}
