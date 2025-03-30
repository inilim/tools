<?php

namespace Inilim\Tool\Method\Arr;

/**
 * @author inilim
 * установить значение если значения по ключу нет
 * @return \Closure(array &$array, string $key, mixed $value):bool
 */
function setValueIfNotExists()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException(__FUNCTION__ . '()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (array &$array, string $key, $value) {
        if (!\Inilim\Tool\Method\Arr\has($array, $key)) {
            \Inilim\Tool\Method\Arr\set()($array, $key, $value);
            return true;
        }
        return false;
    };
}
