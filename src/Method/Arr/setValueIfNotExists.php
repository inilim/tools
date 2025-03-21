<?php

namespace Inilim\Tool\Method\Arr;

/**
 * установить значение если значения по ключу нет
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
function setValueIfNotExists()
{
    return static function (array &$array, string $key, $value) {
        if (!\Inilim\Tool\Method\Arr\has($array, $key)) {
            \Inilim\Tool\Method\Arr\set()($array, $key, $value);
            return true;
        }
        return false;
    };
}
